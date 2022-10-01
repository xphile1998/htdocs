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

-- REPLACE the word 'small' with 'spacious' in the invDescription field in the INVENTORY table of the PHPMOTORS database
UPDATE inventory
SET invDescription = REPLACE (invDescription, "small", "spacious")
WHERE invMake = "GM"
    AND invModel = "Hummer";

-- INNER JOIN task...
SELECT i.invModel,
    cc.classificationName
FROM inventory i
    INNER JOIN carclassification cc ON i.classificationId = cc.classificationId
WHERE cc.classificationName = "SUV";

--