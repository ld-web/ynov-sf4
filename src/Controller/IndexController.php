<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Newsletter;
use App\Form\ContactType;
use App\Form\NewsletterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    /**
     * @Route("/presentation", name="presentation")
     */
    public function presentation()
    {
      return $this->render('index/presentation.html.twig');
    }

    /**
     * @Route("/newsletter", name="newsletter")
     */
    public function newsletter(Request $request, EntityManagerInterface $em)
    {
      // Je crée une instance de mon entité
      $newsletter = new Newsletter();

      // Je crée une instance de formulaire
      // Sur la base de ma classe NewsletterType
      // Et je lie mon entité à ce formulaire
      $form = $this->createForm(NewsletterType::class, $newsletter);

      // Rôle principal : mapper les données du formulaire dans l'entité
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($newsletter);
        $em->flush();
      }

      // Je passe à la vue le résultat de l'appel à la méthode createView
      // Sur l'instance de mon formulaire
      return $this->render('index/newsletter.html.twig', [
        'form' => $form->createView()
      ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, EntityManagerInterface $em)
    {
      // Je crée une instance de mon entité
      $contact = new Contact();

      // Je crée une instance de formulaire
      // Sur la base de ma classe ContactType
      // Et je lie mon entité à ce formulaire
      $form = $this->createForm(ContactType::class, $contact);

      // Rôle principal : mapper les données du formulaire dans l'entité
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($contact);
        $em->flush();
        return $this->redirectToRoute('homepage');
      }

      // Je passe à la vue le résultat de l'appel à la méthode createView
      // Sur l'instance de mon formulaire
      return $this->render('index/contact.html.twig', [
        'form' => $form->createView()
      ]);
    }
}
