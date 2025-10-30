<?php

declare(strict_types=1);

namespace MrcMorales\MetaPixelApiBundle\Factory;

use FacebookAds\Object\ServerSide\UserData;
use Symfony\Component\HttpFoundation\Request;
use FacebookAds\Object\ServerSide\ParameterBuilder;

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
            $userData->setDateOfBirth($dateOfBirth);
        }

        if ($city) {
            $userData->setCity($city);
        }

        if ($countryCode) {
            $userData->setCountryCode($countryCode);
        }

        if ($zipCode) {
            $userData->setZipCode($zipCode);
        }

        $userData->setClientIpAddress($request->getClientIp());
        $userData->setClientUserAgent($request->headers->get('User-Agent'));
        $userData->setFbc($request->query->get('fbclid'));
        $userData->setFbp($request->cookies->get('_fbp'));

        return $userData;
    }
}