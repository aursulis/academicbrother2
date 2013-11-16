<?php
namespace AB\Bundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use AB\Bundle\Entity\User;

class CreateAdminCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('ab:createadmin')
            ->setDescription('Create an administrator user')
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $dialog = $this->getHelperSet()->get('dialog');
        $encfactory = $this->getContainer()->get('security.encoder_factory');

        $validatorfactory = function ($len) {
            return function ($value) {
                if (trim($value) == '') {
                    throw new \Exception('The field cannot be empty');
                }
                if (strlen($value) > 4096) {
                    throw new \Exception('The field cannot be longer than ' . $len . ' characters');
                }
                return $value;
            };
        };

        $username = $dialog->askAndValidate(
            $output,
            'Please enter a username: ',
            $validatorfactory(255),
            20,
            false
        );

        $password = $dialog->askHiddenResponseAndValidate(
            $output,
            'Please enter a password: ',
            $validatorfactory(4096),
            20,
            false
        );

        $email = $dialog->askAndValidate(
            $output,
            'Please enter an email: ',
            $validatorfactory(255),
            20,
            false
        );

        $u = new User();
        $u->setUsername($username);

        $encoder = $encfactory->getEncoder($u);
        $encpass = $encoder->encodePassword($password, $u->getSalt());
        $u->setPassword($encpass);

        $u->setEmail($email);
        $u->setIsActive(true);
        $em->persist($u);
        $em->flush();

        $output->writeln("Administrator $username created");
    }
}

?>
