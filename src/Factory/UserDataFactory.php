<?php

declare(strict_types=1);

namespace MrcMorales\MetaPixelApiBundle\Factory;

use FacebookAds\Object\ServerSide\UserData;
use Symfony\Component\HttpFoundation\Request;
use FacebookAds\ParamBuilder;

final class UserDataFactory
{
    /**
     * @param Request $request
     * @param string|null $email
     * @param string|null $phone
     * @param string|null $firstName
     * @param string|null $lastName
     * @param string|null $dateOfBirth format YYYYMMDD
     *
     * @return UserData
     */
    public static function create(Request $request, ?string $email = null, ?string $phone = null,  ?string $firstName = null, ?string $lastName = null, ?string $dateOfBirth = null, ?string $city = null, ?string $countryCode = null, ?string $zipCode = null): UserData
    {
        $userData = new UserData();
        $paramBuilder = new ParamBuilder([$request->getHost()]);
        $paramBuilder->processRequest(
            $request->getHost(),
            $request->query->all(),
            $request->cookies->all(),
            $request->headers->get('referer')
        );

        $userData->setFbp($paramBuilder->getFbp());
        $userData->setFbc($paramBuilder->getFbc());

        if ($email) {
            $userData->setEmail(hash('sha256', strtolower(trim($email))));
        }

        if ($phone) {
            $userData->setPhone(hash('sha256', preg_replace('/\D/', '', $phone)));
        }

        if ($firstName) {
            $userData->setFirstName(hash('sha256', strtolower(trim($firstName))));
        }

        if ($lastName) {
            $userData->setLastName(hash('sha256', strtolower(trim($lastName))));
        }

        if ($dateOfBirth) {

            if (!preg_match('/^\d{8}$/', $dateOfBirth)) {
                throw new \InvalidArgumentException('dateOfBirth must be in YYYYMMDD format.');
            }

            $year = (int) substr($dateOfBirth, 0, 4);
            $month = (int) substr($dateOfBirth, 4, 2);
            $day = (int) substr($dateOfBirth, 6, 2);

            if (!checkdate($month, $day, $year)) {
                throw new \InvalidArgumentException('dateOfBirth is not a valid date.');
            }

            $userData->setDateOfBirth(hash('sha256', strtolower(trim($dateOfBirth))));
        }

        if ($city) {
            $userData->setCity(hash('sha256', strtolower(trim($city))));
        }

        if ($countryCode) {
            $userData->setCountryCode(hash('sha256', strtolower(trim($countryCode))));
        }

        if ($zipCode) {
            $userData->setZipCode(hash('sha256', strtolower(trim($zipCode))));
        }

        $userData->setClientIpAddress($request->getClientIp());
        $userData->setClientUserAgent($request->headers->get('User-Agent'));


        return $userData;
    }
}