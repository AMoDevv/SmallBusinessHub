-- SQL Commands we will need for the project


---------------------- RETREIVE -----------------------

-- Get Account Data

SELECT accountID, username, account_type
FROM Account,
WHERE pwd = '?';

-- Get User Information
-- UNFINISHED
SELECT generalUserId, firstName, lastName, dateOfBirth, gender, email
FROM GeneralUserInformation
WHERE ;

-- Get Business Information

SELECT bi.businessID, bi.businessName, bi.address_street, bi.address_district, bi.address_number, bi.phone_number, bi.email, bi.facebook_url, bi.instagram_url, bi.twitter_url, bi.website_url, bi.business_description, s.name, s.max_posts
FROM BusinessInformation bi
JOIN Subscription s
ON s.subscriptionID = bi.subscriptionID
WHERE 

;

-- Get User Interests

SELECT c.name, c.description
FROM Interests i 
JOIN Category c
ON i.categoryID = c.categoryID
WHERE i.generalUserId = '';

-- Get Business Categories

SELECT c.name, c.description
FROM BusinessCategory bc 
JOIN Category c
ON bc.categoryID = c.categoryID
WHERE bc.businessID = '';

-- Get Business Posts

SELECT photo, p.description, saves, boost
FROM Posts p
WHERE businessID = ''
;

-- Get Posts By Tag

SELECT p.photo, p.description, p.saves, p.boost
FROM Tags t 
JOIN Posts p 
ON p.postID =  t.postID
WHERE t.tagID = '';


-- Get Saved Posts

SELECT p.photo, p.description, p.saves, p.boost
FROM Saves s
Join Posts p
ON s.postID = p.postID
WHERE s.userID = '';


-----------------------------------------------------

---------------------- CREATE -----------------------

-- Account
INSERT INTO Account (username, pwd, created_at, account_type)
VALUES (value1, value2, value3, value4);

-- GeneralUserInformation
INSERT INTO GeneralUserInformation (firstName, lastName, dateOfBirth, gender, email)
VALUES (value1, value2, value3, value4, value5);

-- Subscription
INSERT INTO Subscription ("name", max_posts)
VALUES (value1, value2);

-- BusinessInformation
INSERT INTO BusinessInformation (businessName, address_street, address_district, address_number, phone_number, email, facebook_url, instagram_url, twitter_url, website_url, business_description, subscriptionID)
VALUES (value1, value2, value3, value4, value5, value6, value7, value8, value9, value10, value11, value12, value13);

-- Category
INSERT INTO Category ("name", "description")
VALUES (value1, value2);

-- Interests
INSERT INTO Interests (generalUserId, categoryID)
VALUES (value1, value2);

-- BusinessCategory
INSERT INTO BusinessCategory (categoryID, businessID)
VALUES (value1, value2);

-- Tags
INSERT INTO Tags (tag, postID)
VALUES (value1, value2);

-- Posts
INSERT INTO Posts (businessID, photo, "description", saves, boost)
VALUES (value1, value2, value3, value4, value5);

-- Saves
INSERT INTO Saves (postID, userID)
VALUES (value1, value2);

-----------------------------------------------------

---------------------- UPDATE -----------------------


-- Account
UPDATE Account
SET username = '', pwd = '', created_at = '', account_type = ''
WHERE accountID = '';

-- GeneralUserInformation
UPDATE GeneralUserInformation
SET firstName = '', lastName = '', dateOfBirth = '', gender = '', email = ''
WHERE generalUserId = '';

-- Subscription
UPDATE Subscription
SET "name" = '', max_posts = ''
WHERE subscriptionID = '';

-- BusinessInformation
UPDATE BusinessInformation
SET businessName = '', address_street = '', address_district = '', address_number = '', phone_number = '', email = '', facebook_url = '', instagram_url = '', twitter_url = '', website_url = '', business_description = '', subscriptionID = ''
WHERE businessID = '';

-- Category
UPDATE Category
SET "name" = '', "description" = ''
WHERE categoryID = '';

-- Interests
UPDATE Interests
SET generalUserId = '', categoryID = ''
WHERE interestID = '';

-- BusinessCategory
UPDATE BusinessCategory
SET categoryID = '', businessID = ''
WHERE businessCategoryID = '';

-- Tags
UPDATE Tags
SET tag = '', postID = ''
WHERE tagID = '';

-- Posts
UPDATE Posts
SET businessID = '', photo = '', "description" = '', saves = '', boost = ''
WHERE postID = '';

-- Saves
UPDATE Saves
SET postID = '', userID = ''
WHERE saveID = '';


-----------------------------------------------------

---------------------- DELETE -----------------------

-- Account
DELETE FROM Account
WHERE accountID = '';

-- GeneralUserInformation
DELETE FROM GeneralUserInformation
WHERE generalUserId = '';

-- Subscription
DELETE FROM Subscription
WHERE subscriptionID = '';

-- BusinessInformation
DELETE FROM BusinessInformation
WHERE businessID = '';

-- Category
DELETE FROM Category
WHERE categoryID = '';

-- Interests
DELETE FROM Interests
WHERE interestID = '';

-- BusinessCategory
DELETE FROM BusinessCategory
WHERE businessCategoryID = '';

-- Tags
DELETE FROM Tags
WHERE tagID = '';

-- Posts
DELETE FROM Posts
WHERE postID = '';

-- Saves
DELETE FROM Saves
WHERE saveID = '';

