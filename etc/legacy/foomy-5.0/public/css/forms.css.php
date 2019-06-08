/*************************************************
 * Formulare allgemein
 */

.zend_form {
  padding: 5px 5px 25px 5px;
  margin: 15px 0 0 0;
}

.zend_form dt {
  float: left;
  padding: 0 0 0 5px;
}

.zend_form dd {
  padding: 3px;
}

#submit-element, #reset-element {
  float:right;
}

#submit-label, #reset-label {
  display:none;
}

.errors {
  font-weight:bold;
  color:red;
}

fieldset {
  border: 0;
  width: 100%;
}

/*************************************************
 * Formularelemente allgemein
 */

textarea {
  border: solid 2px maroon;
}

input[type=text], input[type=password] {
  border: solid 2px maroon;
  width: 200px;
}

input[type=submit], input[type=reset], button {
  background: #ccc;
  padding: 1px;
}

.savebtn {
  color: green;
}

.cancelbtn {
  color: red;
}

.deletebtn {
  padding: 0;
  color: red;
}

.last-field {
  border: double black;
  border-width: 0 0 3px 0;
  padding: 3px 3px 5px 3px;
}


/*************************************************
 * Modul: Default
 * Seite: Splash Screen (Index)
 */

#randomquote {
  width: 500px;
  height: 100px;
}


/*************************************************
 * Modul: Default
 * Seite: Login
 */
#loginform {
  width: 300px;
}

#loginform dt {
  width: 70px;
  padding: 5px 0 0 5px;
}

#loginform .errors {
  margin: 2px 0 3px 70px;
}


/*************************************************
 * Modul: Admin
 * Seite: Zitatverwaltung
 */

#quoteform {
  width: 425px;
}

#quoteform dt {
  width: 85px;
}

#quoteform .errors {
  margin: 2px 0 3px 85px;
}

#quote_id-label {
  display: none;
}

#quotetext {
  width: 300px;
  height: 125px;
}


/*************************************************
 * Modul: Admin
 * Seite: Benutzerverwaltung
 */

#userform {
  width: 350px;
}

#userform dt {
  width: 110px;
}

#userform .errors {
  margin: 2px 0 3px 110px;
}

#user_id-label {
  display: none;
}


/*************************************************
 * Modul: Admin
 * Seite: Benutzergruppenverwaltung
 */
#roleform {
  width: 380px;
}

#roleform dt {
  width: 100px;
}

#roleform .errors {
  margin: 2px 0 3px 80px;
}

#roleform #description {
  width: 250px;
  height: 100px;
}

#role_id-label {
  display: none;
}

/*************************************************
 * Modul: Admin
 * Seite: Menü erstellen
 * Pfad: /menu/create/
 */
#createMenuForm {
  width: 300px;
}

#createMenuForm dt {
  width: 60px
}

#createMenuForm .errors {
  margin: 2px 0 3px 60px;
}

#menu_id-label {
  display: none;
}

/*************************************************
 * Modul: Blog
 * Seite: article/new
 */
#articleform {
  width: 500px;
}

#articleform dt {
  width: 80px;
  margin: 0 0 0 30px;
}

#articleform .errors {
  margin: 2px 0 3px 80px;
}

#articleform #abstract {
  width: 350px;
  height: 125px;
}

#articleform .paragraph {
  width: 350px;
  height: 150px;
}

#articleform #add_paragraph-element {
  float: right;
}

.pSubForm {
  padding: 3px 0 !important;
}

#article_id-label, #blog_id-label, #add_paragraph-label, #pSubForm_0-label {
  display: none;
}

/*************************************************
 * Modul: Blog
 * Seite: article/new
 */
#bookmarkform {
  width: 500px;
}

#bookmarkform dt {
    width: 90px;
}

#bookmarkform .errors {
  margin: 2px 0 3px 80px;
}

#bookmarkform #comment {
  width: 350px;
  height: 150px;
}

#bookmark_id-label {
    display: none;
}
