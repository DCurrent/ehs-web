<?php

////////////////////////////////////////////////////////////////////////////////
//
// Change the $tstacct variable to search for a user
// change the define("BIND", "...") if you want to user another user to bind as 
// for this test.
// Change the define("PASS","...") to the password for that BIND account.
//
// you won't have to do this in practice as the user will be authenticating 
// themselves.
//
// if you look, you'll see the LDAP_SERVER is using the global catalog port
//
////////////////////////////////////////////////////////////////////////////////


error_reporting( -1 );
ini_set( 'display_errors', 1 );

$tstacct = "dvcask2";
//$tstacct = "testmc1";

// LDAP constants
define("LDAP_SERVER", "ldap://ad.uky.edu:3268");
define("LDAPS_SERVER", "ldaps://ad.uky.edu:3269");

define("BASE_CONTEXT", "dc=uky,dc=edu");

//////////////////////////
////// CHANGE HERE ///////
//////////////////////////
define("BIND", "cn=dvcask2,ou=users-fa,dc=ad,dc=uky,dc=edu");
define("PASS", "64CeeHello@!");
//////////////////////////
//////////////////////////

$filter = "samaccountname=$tstacct";
$attributes = array("displayname", "sn", "givenname", "pwdlastset");

$foundUser = false;

// Try to find test user
$found = ldapSearch(LDAP_SERVER, BIND, PASS, BASE_CONTEXT, $filter, $attributes);
$found = ldapSearch(LDAPS_SERVER, BIND, PASS, BASE_CONTEXT, $filter, $attributes);

if (! $found)
{
   echo "\n\n User not found\n\n";
}

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
function ldapSearch($LDAP_SERVER, $BIND, $PASS, $BASE_CONTEXT, $filter, $attributes)
{
   // Initialize return code
   $rc = 0;

echo "LDAPSERVER: $LDAP_SERVER\n";
echo "BIND: $BIND\n";

   // Try and find this user in Active Directory
      if (!($conn = ldap_connect($LDAP_SERVER))) {
      echo "error connecting to LDAP server\n";
   }

   else {
      ////////  ADDED THESE TWO LINES TO ACCESS LDAP FOR AD UNDER SERVER 2003
      ldap_set_option($conn, LDAP_OPT_REFERRALS, 0);
      ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
      ///////////////////////////////////////////////////////////////////////

      if (!($goob = @ldap_bind($conn, $BIND, $PASS))) {
         // Set error message and pass it to rError
         echo "Bad username or password.\n";
         ldap_error($conn);
      }
      else {
         // Pull attributes for the AD domain
         $sr=ldap_search($conn, $BASE_CONTEXT, $filter, $attributes);

         // If no entries are found, return 0.
         if (!($count = ldap_count_entries($conn, $sr))) {
            return $rc;
         }
         else {
            echo "found $count entrie(s)\n";

            $rc = 1;

            // get the entries
            $info = ldap_get_entries($conn, $sr);
            echo "DN is: " . $info[0]["dn"] . "\n";
            echo "First Name " . $info[0]["givenname"][0]. "\n";
            echo "surname " . $info[0]["sn"][0]. "\n";
            echo "displayName: " . $info[0]["displayname"][0]. "\n";
            echo "pwdlastset: " . $info[0]["pwdlastset"][0]. "\n";

            print_r($info);
         }

      }

      // Get rid of our connection
      ldap_unbind($conn);

   }
   return $rc;
}
?>

