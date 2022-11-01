Ambulatorio - release 20180331 - March 31, 2018

"Ambulatorio" is a server-based outpatients managing software written in PHP and MySQL. The user interface, made of HTML, CSS and small chunks of Javascript, is basic and in Italian only. Probably the main peculiarity is that I am a medical doctor and I programmed it to meet my professional requirements, without asking an expert programmer to translate what I need for my clinical practice.

This software have been written by Lucio Marinelli with the exception of the code to generate the "CODICE FISCALE" that has been written by Riccardo Frizzoni (GPL2) and the code to perform the automated backup of the database that has been written by David G Walker BSc (http://www.dwalker.co.uk) (GPL2).


Main Features

    Patients data manager (anagrafica)
    Patients history with customizable structure (anamnesi strutturata)
    Clinical scales such as Hoehn&Yahr, UPDRS, MMSE (scale cliniche)
    Visit records
    Search based on structured patients' history
    Automated DB backup (thank to David G Walker BSc http://www.dwalker.co.uk)
    Automatic generation of CODICE FISCALE (thank to Riccardo Frizzoni)
    Statistics page with report of total visits in a year divided by type
    Operations logging




    Copyright (C) <2013>  <Lucio Marinelli>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

To contact the author please visit the website https://www.luciomarinelli.com

To install, import the Database_structure.sql into your MySQL database, configure the config.inc.php file and upload all the files into a folder on your Apache/PHP configured server preserving the subfolders structure. Manually add at least one "cognome" and "password" credential record in "medici" table in order to log in.


**Future directions**

* Convert mysql calls to msqli since MySQL extension is removed from PHP version 7.1 (use https://github.com/philip/MySQLConverterTool ?) *

* Improving graphic and usability

* Translate into English and languages other than Italian

* Ambulatorio is currently designed for neurological "movement disorders" outpatients; making it suitable for other specialities implies adding specific structured history (anamnesi strutturata) and dedicated clinical scales (scale cliniche)

* Adding support for databases other than MySQL (MariaDB...)

* Improve code readability

* Encrypt sensitive informations

* Ask for confirmation before closing unsaved windows

* ... suggest other implementations!

