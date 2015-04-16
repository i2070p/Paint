<?php

// src/AppBundle/Command/GreetCommand.php

namespace TasksBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class EmailTestCommand extends ContainerAwareCommand {

    protected function configure() {
        $this
                ->setName('comm:emailTest')
                ->setDescription('Email test...')
                ->addArgument(
                        'msg', InputArgument::OPTIONAL, 'Short message: ')
                ->addArgument(
                        'email_to', InputArgument::OPTIONAL, 'To: '
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $msg = $input->getArgument('msg');
        $email_to = $input->getArgument('email_to');
        $smtp_host_ip = gethostbyname('smtp.gmail.com');
        $transport = \Swift_SmtpTransport::newInstance($smtp_host_ip, 465, 'ssl')
                        ->setUsername('metiv9@gmail.com')->setPassword('v9z2ygqo2');
        $message = \Swift_Message::newInstance()
                ->setSubject('Test')
                ->setFrom($email_to)
                ->setTo($email_to)
                ->setBody($msg, 'text/html')
        ;
       

        $mailer = $this->getContainer()->get('mailer');//\Swift_Mailer::newInstance($transport);

        $mailer->send($message);
    }

}
