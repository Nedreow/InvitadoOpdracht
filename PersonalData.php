<?php


class PersonalData
{
    public int $salutation;

    public string $customSalutation;

    public string $firstName;

    public string $lastName;

    public string $email;

    public DateTime $birthday;

    public string $country;

    function __construct(array $formPost)
    {
        $this->salutation = $formPost["salutation-select"];
        if ($formPost["salutation-select"] === 1)
        {
            $this->customSalutation = $formPost["salutation-other"];
        }

        $this->firstName = $formPost["first-name"];
        $this->lastName = $formPost["last-name"];

        if (filter_var($formPost["email"], FILTER_VALIDATE_EMAIL)) {
            $this->email = $formPost["email"];
        }

        $this->birthday = DateTime::createFromFormat("Y-m-d", $formPost["birthday"]);

        $this->country = $formPost["country"];
    }

    function save(): void
    {
        $conn = DatabaseConfig::getConnection();

        $sql = "INSERT INTO personal_data (salutation, custom_salutation, first_name, last_name, birthday, email, country) VALUES (?,?,?,?,?,?,?)";
        $stmt= $conn->prepare($sql);
        $stmt->execute([
            $this->salutation,
            $this->customSalutation,
            $this->firstName,
            $this->lastName,
            $this->birthday,
            $this->email,
            $this->country,
        ]);
    }
}