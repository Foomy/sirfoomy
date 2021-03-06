#navigation {
  border: solid 1px black;
  width: 170px;
  margin: auto;
  font-size:0.9em;
}

#navigation .title {
  background: url('/img/head_bg_left.png') repeat-y;
  border: solid black;
  border-width: 0 0 2px 0;
  padding: 6px 0 6px 15px;
  margin:0;
  font-weight: bold;
  font-size: 0.9em;
}

#navigation li {
  background: white;
  border: solid black;
  border-width: 1px 0 0 0;
}

#navigation .e1 {
  border: solid #bbb;
  border-width: 1px 0 0 0 !important;
}

#navigation li:hover {
  background:#f27a2a;
}

#navigation li a {
  display: block;
  margin: 0;
  padding: 3px 0 3px 5px;
  color: #567ec4;
}

#navigation li a:hover {
  color: black;
  text-decoration: none;
}

#navigation .active {
  background:#f59122 !important;
}

#navigation .active a {
  color: black !important;
}

#navigation .first {
  border:0;
}

ul ul li a {
  padding: 3px 0 3px 15px !important;
}
