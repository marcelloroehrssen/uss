<?php

namespace App\Controller\Admin;

use App\Entity\Attribute;
use App\Entity\AttributeDot;
use App\Entity\Background;
use App\Entity\BackgroundDot;
use App\Entity\Character;
use App\Entity\Defect;
use App\Entity\Downtime;
use App\Entity\DowntimeDefinition;
use App\Entity\Faction;
use App\Entity\Faith;
use App\Entity\IntroductionText;
use App\Entity\Inventory;
use App\Entity\Item;
use App\Entity\Job;
use App\Entity\JobType;
use App\Entity\Skill;
use App\Entity\SkillDot;
use App\Entity\SkillGroup;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Una sporca storia - Pannello amministrazione')
            ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Testi Introduttivi', 'fas fa-spell-check', IntroductionText::class);
        yield MenuItem::linkToCrud('Utenti', 'fas fa-user-edit', User::class);
        yield MenuItem::subMenu('Personaggi', 'fas fa-street-view')->setSubItems([
            MenuItem::linkToCrud('Lista', 'fas fa-users', Character::class),
            MenuItem::linkToCrud('Inventari', 'fas fa-warehouse', Inventory::class),
            MenuItem::linkToCrud('Azioni in narrativa', 'fas fa-briefcase-medical', Downtime::class)
        ]);
        yield MenuItem::subMenu('Creazione PG', 'fas fa-user-plus')->setSubItems([
            MenuItem::linkToCrud('Difetti', 'fas fa-blind', Defect::class),
            MenuItem::linkToCrud('Attributi', 'fas fa-user-shield', Attribute::class),
            MenuItem::linkToCrud('Fedi', 'fas fa-pray', Faith::class),
            MenuItem::linkToCrud('Fazioni', 'fas fa-users', Faction::class),
            MenuItem::linkToCrud('Mestieri', 'fas fa-user-md', Job::class),
            MenuItem::linkToCrud('Gruppi di Abilità ', 'fas fa-layer-group', SkillGroup::class),
            MenuItem::linkToCrud('Abilità', 'fas fa-user-nurse', Skill::class),
            MenuItem::linkToCrud('Background', 'fas fa-user-nurse', Background::class),
            MenuItem::linkToCrud('Tipologie di Mestiere', 'fas fa-user-graduate', JobType::class),
            MenuItem::linkToCrud('Pallini Attributi', 'fas fa-ellipsis-h', AttributeDot::class),
            MenuItem::linkToCrud('Pallini Abilità', 'fas fa-ellipsis-h', SkillDot::class),
            MenuItem::linkToCrud('Pallini Background', 'fas fa-ellipsis-h', BackgroundDot::class),
        ]);
        yield MenuItem::linkToCrud('Definizione Azioni', 'fas fa-briefcase', DowntimeDefinition::class);
        yield MenuItem::linkToCrud('Oggetti', 'fas fa-box-open', Item::class);

    }
}
