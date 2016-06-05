<?php
namespace Axipi\GoogleBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\HttpFoundation\RequestStack;

class RecaptchaValidator extends ConstraintValidator
{
    private $secretkey;

    private $request;

    public function __construct(
        $secretkey,
        RequestStack $requestStack
    ) {
        $this->secretkey = $secretkey;
        $this->request = $requestStack->getCurrentRequest();
    }

    public function validate($value, Constraint $constraint)
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ['secret' => $this->secretkey, 'response' => $this->request->request->get('g-recaptcha-response'), 'remoteip' => $this->request->getClientIp()]);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result);

        if(isset($result->success) == 0 || !$result->success) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $this->formatValue($value))
                ->addViolation();
        }
    }
}
