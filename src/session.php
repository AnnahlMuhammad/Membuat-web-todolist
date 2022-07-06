<?php

class Session
{
    public function __construct(public string $username, public string $role)
    {
    }
}

class SessionManagement
{
    public static string $SECRET_KEY = "fjnljaicnuwe8nuwvo8nfulvieufksvfukenkfnelvnuf";

    public static function login(string $username, string $password): bool
    {
        if ($username == "annahl" && $password == "annahl") {
            $payload = [
                "username" => $username,
                "role" => "customer"
            ];

            $jwt = \Firebase\JWT\JWT::encode($payload, SessionManagement::$SECRET_KEY, 'HS256');
            setcookie("X-USER-TOKEN", $jwt);

            return true;
        } else {
            return false;
        }
    }

    public static function getCurrentSession()
    {
        if ($_COOKIE["X-USER-TOKEN"]) {
            $jwt = $_COOKIE["X-USER-TOKEN"];
            try {
                $payload = \Firebase\JWT\JWT::decode($jwt, new \Firebase\JWT\Key( SessionManagement::$SECRET_KEY, 'HS256'));
                return new Session(username: $payload->username, role: $payload->role);
            } catch (Exception $exception) {
                // throw new Exception("User is not login");
                return false;
            }
        } else {
            throw new Exception("User is not login");
        }
    }
}
