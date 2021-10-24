Advanced Web Final Project

Key Notes:
1. To upload images larger than the size 1mb, you must go into the file my.cnf OR my.ini and change max_allowed_packet to:
max_allowed_packet=4M;
After having done this, please restart your server.
2. Upload the .sql file to your desired web server. As you will notice, certain tables such as account_type, category, and subscription come with pre-defined data. The reason for this is that such data gives core functionality to our website.
3. Login in by typing http://localhost/smallbusinesshub/login.php




What is missing?
1. Ability to Edit Profile. That be, update the contents of tables general_user_information & business_information not the their category.
2. Search Feature for the general user.
3. Business users' ability to post pictures and include relevant information such as tags.
4. Ability to subscribe. Currently, all business users fall under subscription 1 (10 max posts). However, if they were to want to upgrade we must provide this feature.
5. Ability to like/save posts.

