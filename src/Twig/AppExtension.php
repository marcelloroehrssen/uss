<?php

namespace App\Twig;

use App\Entity\InventoryEntry;
use App\Entity\Item;
use Doctrine\ORM\PersistentCollection;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public static $units = [
        'y' => 'year',
        'm' => 'month',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    ];

    private $translator;

    public function __construct(TranslatorInterface $translator = null)
    {
        // Ignore the IdentityTranslator, otherwise the parameters won't be replaced properly
        if ($translator instanceof IdentityTranslator) {
            $translator = null;
        }

        $this->translator = $translator;
    }

    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('containsItem', [$this, 'containsItem']),
            new TwigFilter('time_diff', [$this, 'diff'], ['needs_environment' => true]),
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('getDowntimeItemBadge', [$this, 'getDowntimeItemBadge'])
        ];
    }

    public function containsItem(PersistentCollection $inventoryEntry, Item $item)
    {
        return $inventoryEntry->exists(function (int $index, InventoryEntry $entry) use ($item) {
            return $entry->getItem()->getName() === $item->getName();
        });
    }

    public function getDowntimeItemBadge($inInventory, $isAssigned)
    {
        if ($inInventory && $isAssigned) {
            return ['green', 'Tutto ok!'];
        } else if ($inInventory && !$isAssigned) {
            return ['yellow', 'Nell\'inventario ma non assegnato a questa azione'];
        } else if (!$inInventory && $isAssigned) {
            return ['yellow', 'Assegnato all\'azione ma non più nell\'inventario'];
        } else {
            return ['red', 'Non presente ne nell\'inventario ne assegnato all\'azione'];
        }
    }

    public function diff(Environment $env, $date, $now = null)
    {
        // Convert both dates to DateTime instances.
        $date = twig_date_converter($env, $date);
        $now = twig_date_converter($env, $now);

        // Get the difference between the two DateTime objects.
        $diff = $date->diff($now);

        // Check for each interval if it appears in the $diff object.
        foreach (self::$units as $attribute => $unit) {
            $count = $diff->$attribute;

            if (0 !== $count) {
                return $this->getPluralizedInterval($count, $diff->invert, $unit);
            }
        }

        return '';
    }

    private function getPluralizedInterval($count, $invert, $unit)
    {
        if ($this->translator) {
            $id = sprintf('diff.%s.%s', $invert ? 'in' : 'ago', $unit);

            return $this->translator->transChoice($id, $count, ['%count%' => $count], 'date');
        }

        if (1 !== $count) {
            $unit .= 's';
        }

        return $invert ? "in $count $unit" : "$count $unit ago";
    }
}
