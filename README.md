<h2>Project Name: Blog Application</h2>
<p><strong>Project Features:</strong></p>
<ul>
    <li>User Login System</li>
    <li>Authorized User would be access landing page where all blogs lives</li>
    <li>User can create new blog update existing and also will be able to delete blog </li>
</ul>
<p><strong>Project Installation Guide:</strong></p>
<ul>
    <li>Open Terminal</li>
    <li>Go to backend path and run composer update, 
        after completing run command php artisan key generate. 
        setup your database from .env file.
        run php artisan migrate,
        run php artisan db:seed,
        after that run php artisan serve. Nice your backend is ready.</li>
    <li>Now, Go to frontend folder run command npm install.After that run npm run dev. Boo, your frontend is ready too.
    open the link that you found on your terminal.</li> 
</ul>
<p><strong>Technologies Used</strong></p>
<ul>
    <li>Laravel 11</li>
    <li>Vue.js 3</li>
    <li>MySQL</li>
</ul>

<p><strong>Project Brief:</strong></p>
<p>
In this application I used VueJs for Frontend and Laravel for Backend, database used
MySQL. When user try to log in to the system through api data are validating with 
well manner and in frontend if users make any validation error the message 
shown perfectly. User will be able to create and edit data in one form which will
gave them better user experience. In frontend routes are properly protected
only authenticate user able to access blogs page.
</p>

    
