<?php

namespace Gwd\Bundle\ContactBundle\Controller\Frontend;

use Oro\Bundle\LayoutBundle\Attribute\Layout;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


use Oro\Bundle\ConfigBundle\Config\ConfigManager;


class ContactController extends AbstractController

{
    private ConfigManager $configManager;

    public function __construct(ConfigManager $configManager)
    {
        $this->configManager = $configManager;
    }

    #[Route('/contact',name:'contact_us')]
    #[Layout]
    public function indexAction(Request $request)
    {
        return [];
    }

    #[Route('/contact/submit',name:'contact_us_submit')]
    public function submitAction(Request $request,MailerInterface $mailer):Response
    {
        $firstName = $request->request->get('firstName');
        $lastName = $request->request->get('lastName');
        $phone = $request->request->get('phone');
        $email = $request->request->get('email');
        $subject = $request->request->get('subject');
        $message = $request->request->get('message');

        $siteEmail = $this->configManager->get('gwd_config.contact_page_to_email');
        if (empty($siteEmail) || !filter_var($siteEmail, FILTER_VALIDATE_EMAIL)) {
            $siteEmail = 'galm85@gmail.com'; // Fallback email
        }


        $emailMessage = (new Email())
            ->from($email)
            ->to($siteEmail)
            ->subject('Contact Form' . $subject)
            ->html("
                            <h3>New Contact Form Submission</h3>
                <p><strong>Name:</strong> {$firstName} - {$lastName}</p>
                <p><strong>Phone:</strong> {$phone}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Subject:</strong> {$subject}</p>
                <p><strong>Message:</strong></p>
                <p>{$message}</p>
            ");

        $mailer->send(($emailMessage));
        $this->addFlash('success','Thank you');

        return $this->redirectToRoute('contact_us');


    }

}