/** COMMON
 */
ul {
  list-style-type:none;
}
hr {
	width:90%;
	color:orange;
}
p {
  margin:0 0 15px 0;
}
a {
	text-decoration:none;
	font-weight:bold;
	color:#567ec4;
}
a:hover {
	text-decoration:underline overline;
	color:#90b0f0;
}
a.invis {
  font-size:7pt;
  font-weight:normal;
  color:black;
  cursor:default;
}
a.invis:hover {
  text-decoration:none;
  cursor:text;
}
h1 {
  font-size:1.5em;
  margin:15px 0 25px 0;
}
h2 {
  font-size:1.4em;
  margin:15px 0 20px 0;
}
h3 {
  font-size:1.3em;
  margin:15px 0 15px 0;
}
h4 {
  font-size:1.1em;
  margin:15px 0 10px 0;
}
h5 {
  font-size:1em;
  margin:15px 0 5px 0;
}
.head1 {
	font-size:1.5em;
	font-weight:bold;
}
.head2 {
	font-size:1.4em;
	font-weight:bold;
}
.head3 {
	font-size:1.3em;
	font-weight:bold;
}
.head4 {
  font-size:1.1em;
  font-weight:bold;
}
.head5 {
	font-size:1em;
	font-weight:bold;
}
#pagetitle {
  margin:0 0 20px 0;
}
.fett {
	font-weight:bold;
}
.kursiv {
  font-style:italic;
}
.small {
	font-size:7pt;
	font-weight:normal; 
}
#messages {
  border:solid 1px #ff7f55;
  background:#ffd47f;
  padding:5px;
  margin: 0 0 10px 0;
  font-weight:bold;
  color:red;
  display:none;
}
.error {
	font-size:7pt;
	font-weight:bold;
	color:red;
	vertical-align:top;
	padding:0;
}
.codebox {
	background:#555555;
	border:solid 1px white;
	border-left:0;
	border-right:0;
}

/** LISTS
 */
.listing {
  border-collapse:collapse;
}
.listing th {
  border-bottom:double 3px black;
  padding:0 0 1px 0;
}
.listing td {
  padding:2px 5px;
  vertical-align:top;
}
.listing .id {
  width:10px;
  padding:0 2px 0 0;
  text-align:right;
  vertical-align:top;
}
.listing .ico {
  width:16px;
  padding:2px 0;
}

/** HEADER
 */
#slogan {
  position:absolute;
  top:70px;
  left:40px;
  font-size:7pt;
}
#login {
  width:80px;
  margin:10px 10px;
  text-align:center;
}
#logout {
  border:outset 2px black;
  width:80px;
  margin:10px 10px;
  text-align:center;
  float:right;
}
#logout a {
  background:white;
  display:block;
  width:76px;
  padding:2px;
  color:red;
}
#logout:hover {
  border:inset 2px black;
}
#logout a:hover {
  background:#eee;
  text-decoration:none;
}

/** STATUSLEISTE
 */
#statusTbl {
  width:100%;
}
#breadcrumb {
  font-size:8pt;
  font-weight:bold;
  padding:0 0 0 15px;
}
#datum {
  font-size:8pt;
  width:100px;
  font-weight:bold;
  text-align:center;
}

/** RIGHTBOX
 */
#links {
  border:solid 1px #d44;
  text-align:left;
  margin:5px 3px 10px 3px;
}
#links .head {
  background:#d44;
  padding:3px;
  font-size:7pt;
  font-weight:bold;
  color:black;
  text-align:center;
}
#links .body {
  padding:4px;
  font-size:8pt;
}

/** FOOTER
 */
#footerTbl {
  border-collapse:collapse;
  width:100%;
  margin:5px 0 0 0;
}
#footerLeftbox {
  width:150px;
  text-align:center;
}
#footerCenterbox {
  font-size:8pt;
  text-align:center;
}
#footerRightbox {
  width:150px;
  text-align:center;
}
#geekcode {
  font-family:arial, sans-serif;
  font-size:8pt;
  font-weight:bold;
  color:red;
  margin:0;
  padding:5px 0 15px 0;
}

/** STARTSEITE (SPLASH)
 */
#quote {
  width:500px;
	margin:20px auto;
}
#optimized {
  margin:20px 0 0 0;
	text-align:center;
}
#entrance {
 border:dashed 1px maroon;
	width:140px;
	padding:10px;
  margin:20px auto;
	text-align:center;
}
#fundisclaimer {
  margin:20px auto;
	text-align:justify;
	width:418px;
}

/** HOME
 */
#motto {
  width:450px;
  margin:20px;
}
#motto div {
  margin:7px 0 0 0;
  text-align:right;
}
#fehlliste li {
  margin:0 0 3px 0;
  padding:2px;
}

/** IMPRESSUM
 */
#impressum p {
  padding:0 0 0 30px;
	text-align:justify;
}
#impressum .broken {
	margin:10px 30px 0 30px;
}
#impimg {
	background:url(/img/impressum.png);
	width:300px;
	height:200px;
	margin:15px 0 20px 85px;
	text-align:center;
}
#impimgSchutz {
	width:300px;
	height:200px;
}
#foomySignatur {
	margin-top:15px;
	font-size:8pt;
	text-align:right;
}

/** ULAM
 */
#auswertung {
	border:solid 1px black;
	margin-top:5px;
	width:460px;
}
#auswertung th {
	border:solid 1px black;
	text-align:left;
	padding:3px;
	width:100px;
}
#auswertung td {
	border:solid 1px black;
}

/** FAQ
 */
.antwort {
	margin:5px 0 10px 0;
	padding:0 10px 0 20px;
	text-align:justify;
}

/** MAINTENANCE
 */
#maintenance_text {
  font-size:12pt;
  margin:50px 0 50px 50px;
}

/** BLOG
 */
.entry {
  width:80%;
  margin:20px auto;
  border-right:solid 1px white;
  border-left:solid 1px white;  
}
.entryhead {
  padding:2px;
}
.entrybody {
  text-align:justify;
  padding:10px 15px 10px 15px;
}
.entryfoot {
  text-align:right;
  padding:2px;
}

/** QUOTES (admin)
 */
#quotelist {
  font-size:0.8em;
}
#quotelist .quot {
  width:45%;
}
#quotelist .auth {
  width:20%;
}

/** GROUPS (admin)
 */

/** RATING
 */
#legend {
  height:15px;
  padding:0 0 0 30px;
}
#legend .val {
  float:left;
  width:25px;
  text-align:center;
}
.rating_container {
  height:25px;
  margin:0 0 10px 0;
  padding:0 0 0 30px;
}
.rating_container a {  
  float:left;
  display:block;
  width:25px;
  height:25px;
  border:0;
  background-image:url("/img/rating.gif");
} 
.rating_container a.rating_off {
  background-position:0 0px;
}
.rating_container a.rating_half {
  background-position:0 -25px;
}
.rating_container a.rating_on {
  background-position:0 -50px;
}
.rating_container a.rating_selected {
  background-position:0 -75px;
}
#auswertung th {
  border:0;
  text-align:left;
}
#auswertung td {
  border:0;
  padding:2px 0 2px 5px;
}
#auswertung input[type=text] {
  border:0;
}

/** NOTICE
 */
#noticebox .ctrl {
  margin:5px 0 0 0;
}
#noticebox .nlist {
  margin:30px 0 0 0;
}
#noticebox .nlist_element {
  border:solid 1px #aeaeae;
  padding:5px;
  margin:0 0 5px 0;
}

/** Dots'n'Boxes
 */
#gamematrix {
  border-collapse:collapse;
}
#gamematrix .dot {
  border:solid 1px black;
  width:10px;
  height:10px;
}
#gamematrix .hline {
  width:30px;
  height:10px;
}
#gamematrix .vline {
  width:10px;
  height:30px;
}