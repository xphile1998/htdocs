-- INSERT a record into the the CLIENTS table in the PHPMOTORS database
INSERT INTO clients (
        clientFirstName,
        clientLastname,
        clientEmail,
        clientPassword,
        comment
    )
VALUES (
        "Tony",
        "Stark",
        "tony@starknet.com",
        "Iam1ronM@n",
        "I am the real Ironman"
    );

-- UPDATE the Stark entry in the CLIENT table to clientLevel='3'
UPDATE clients
SET clientLevel = '3'
WHERE clientEmail = "tony@starknet.com";

