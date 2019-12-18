<?php

namespace App\Controller;

use App\Entity\Ads;
use App\Form\AdType;
use App\Entity\Addresses;
use Cocur\Slugify\Slugify;
use App\Repository\AdsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
     * @Route("/ad")
     */
class AdController extends AbstractController
{
    /**
     * Display all ads
     *
     * @Route("s", name="ads")
     */
    public function index(AdsRepository $repo)
    {
        $ads = $repo->findAll();

        return $this->render('ad/index.html.twig', [
            'ads' => $ads
        ]);
    }

    /**
     * Create a ad
     * 
     * @IsGranted("ROLE_USER")
     * 
     * @Route("/create", name="create_ad")
     */
    public function create(Request $request, ValidatorInterface $validator)
    {
        $errors = [];
        //Create a new ad
        $ad = new Ads();
        // Create adress
        //$adress = new Addresses;
        // create form
        $form = $this->createForm(AdType::class, $ad);
        //retrieve handle request
        $form->handleRequest($request);

        // When the form is submited and valid
        if ($form->isSubmitted() && $form->isValid()) {
            // error management
            $errrors = $validator->validate($ad);
            // innitilialize country
            $lg=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            // set langage of user
            $ad->setLangage($lg);
            // slug
            $slugify = new Slugify();
            $ad->setSlug($slugify->slugify($ad->getTitle()));
            // add createdBy
            $ad->setCreatedBy($this->getUser());
            // add created date
            $now = new \DateTime();
            $ad->setDatePublish($now);
            // clone and modify date for generate a expire date
            $dateExpire = clone $now;
            $dateExpire->modify('+15 day');
            // add date expire
            $ad->setDateExpire($dateExpire);
            // createdBy get user
            $user = $this->getUser();
            $ad->setCreatedBy($user);
            // persist and flush ad
            //$adress->setCountry('en');
            //$ad->Adresses->setLocation($adress);
            // Persist
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($ad);
            $manager->flush();
            
            $this->addFlash(
                'success',
                "Ad has been created"
            );

            //return $this->redirectToRoute('read_ad', ['id' => $ad->getId()]);
            return $this->redirectToRoute('home');
        }
        
        return $this->render('ad/create.html.twig', [
            'form' => $form->createView(),
            'errors' => $errors
        ]);
    }

    /**
     * 
     * 
    * @Route("/read/{id}", name="read_ad")
    */
    public function read( Ads $ad)
    {
        return $this->render('ad/read.html.twig', [
            'ad' => $ad
        ]);
    }

    /**
    * @Route("/{id}/edit", name="edit_ad")
    */
    public function edit(Ads $ad, Request $request)
    {

        $form = $this->createForm(AdType::class, $ad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home');
            //return $this->redirectToRoute('read_ad', ['id' => $ad->getId()]);
        }

        return $this->render('ad/edit.html.twig', [
            'category' => $ad,
            'form' => $form->createView(),
        ]);
    }

    /**
    * Remove manager. 
    *
    * @Route("/{id}/delete", name="delete_ad")
    */
    public function delete( Ads $ad)
    {

        $manager = $entityManager = $this->getDoctrine()->getManager();
        //remove manager
        $manager->remove($ad);
        $manager->flush();
        
        $this->addFlash(
            'success',
            "Article has been deleted"
        );



        return $this->render('ad/delete.html.twig', []);
    }
}
