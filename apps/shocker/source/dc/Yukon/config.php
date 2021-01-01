<?php

namespace dc\yukon;

// Basic configuration and default values.
abstract class DEFAULTS
{
	// Connection options
	const HOST 					= '';						// Database host (server name or address)
	const NAME 					= '';						// Database logical name.
	const USER 					= '';						// User name to access database.
	const PASSWORD				= '';						// Password to access database.
	const CHARSET				= 'UTF-8';					// Character set.
	
	// Query options.
	const SCROLLABLE 			= SQLSRV_CURSOR_FORWARD;	// Cursor type.
	const SENDSTREAM 			= TRUE;						// Send whole parameter stream (TRUE), or send chunks (FALSE).
	const TIMEOUT				= 300;						// Query time out in seconds.	
	
	// Line options. 
	const FETCHTYPE				= SQLSRV_FETCH_ASSOC;		// Default row array fetch type.
	const ROW					= SQLSRV_SCROLL_NEXT;		// Row to access in a result set that uses a scrollable cursor.
	const OFFSET				= 0;						// Row to access if row is absolute or relative. 
	
	// Error exemptions. These codes will be ignored
	// by the respective layer of error trapping.
	const EXEMPT_ALL			= -1;						// If this is placed into any list, then all codes in that list will be considered exempt.
	const EXEMPT_CODES_CATCH	= '-1';						// Catching of thrown exceptions.
	const EXEMPT_CODES_DRIVER	= '0, 5701, 5703';			// Detection of errors from database driver.
	const EXEMPT_CODES_THROW	= '';						// Throwing exception codes.
	
	// New IDs. Passing these as IDs in upsert type quries ensures 
	// the databse engine will find no matches and create 
	// a new record.
	const NEW_ID				= -1;					
	const NEW_GUID				= '00000000-0000-0000-0000-000000000000';
}

// Codes output by thrown exceptions. Use these to take action
// in catch blocks outside of Yukon.
abstract class EXCEPTION_CODE
{
	const CONNECT_CLOSE_FAIL		= 0;	// Driver returned failure response attempting to close database connection.
	const CONNECT_CLOSE_CONNECTION	= 1;	// There is no connection to close.
	const CONNECT_OPEN_FAIL			= 2;	// Driver returned failure response attempting to connect to database.
	const CONNECT_OPEN_HOST			= 3; 	// Application did not provide a host target to connect.
	const FIELD_COUNT_ERROR			= 4;	// Field count returned an error code.
	const FIELD_COUNT_STATEMENT		= 5;	// Missing or invalid query statement getting field count.
	const FREE_STATEMENT_ERROR		= 6;	// Free statement returned an error code.
	const FREE_STATEMENT_FAIL		= 7;	// Free statement returned failure.
	const FREE_STATEMENT_STATEMENT	= 8;	// Free statement called when there is no valid statement.
	const METADATA_ERROR			= 9;	// Metadata returned an error code.
	const METADATA_STATEMENT		= 11;	// Missing or invalid query statement getting metadata.
	const QUERY_EXECUTE_ERROR		= 12;	// Execute returned an error code.
	const QUERY_EXECUTE_FAIL		= 13;	// Execute returned a failure response.
	const QUERY_EXECUTE_STATEMENT	= 14;	// Missing or invalid query statement on execution.
	const QUERY_PREPARE_CONFIG		= 15;	// Prepare query - No valid database config.
	const QUERY_PREPARE_CONNECTION	= 16;	// Prepare query - No connection to database.
	const QUERY_PREPARE_PARAM_ARRAY	= 17;	// Prepare query - No valid array of parameters.
	const QUERY_PREPARE_PARAM_LIST	= 18;	// Prepare query - No valid list of parameters.
	const QUERY_PREPARE_SQL			= 19;	// Prepare query - No valid SQL string.
	const ROW_COUNT_ERROR			= 20;	// Row count returned an error code.
	const ROW_COUNT_STATEMENT		= 21;	// Missing or invalid query statement getting row count.
}

// Output given by interal exception handler.
abstract class EXCEPTION_MSG
{
	const CONNECT_CLOSE_FAIL		= 'Close Connection - Failed closing connection to host.';
	const CONNECT_CLOSE_CONNECTION	= 'Close Connection - No valid connection to close.';
	const CONNECT_OPEN_FAIL			= 'Close Connection - Failed to open connection with host.';
	const CONNECT_OPEN_HOST			= 'Close Connection - Missing or invalid host argument.';
	const FIELD_COUNT_ERROR			= 'Field Count - Error occurred.';
	const FIELD_COUNT_STATEMENT		= 'Field Count - Missing or invalid statement.';
	const FREE_STATEMENT_ERROR		= 'Free Statement - Error occurred.';
	const FREE_STATEMENT_FAIL		= 'Free statement - Failed to free statement.';
	const FREE_STATEMENT_STATEMENT	= 'Free Statement - No valid statement to free.';
	const METADATA_ERROR			= 'Get Metadata - Error occurred.';
	const METADATA_STATEMENT		= 'Get Metadata - Missing or invalid statement.';
	const QUERY_EXECUTE_ERROR		= 'Query Execute - Error occurred.';
	const QUERY_EXECUTE_FAIL		= 'Query Execute - Failed to execute prepared query.';
	const QUERY_EXECUTE_STATEMENT	= 'Query Execute - Missing or invalid statement.';
	const QUERY_PREPARE_CONFIG		= 'Query Prepare - Missing or invalid database config.';
	const QUERY_PREPARE_CONNECTION	= 'Query Prepare - Missing or invalid database connection.';
	const QUERY_PREPARE_PARAM_ARRAY	= 'Query prepare - Missing or invalid parameter array.';
	const QUERY_PREPARE_PARAM_LIST	= 'Query prepare - Missing or invalid parameter list.';
	const QUERY_PREPARE_SQL			= 'Query prepare - Missing or invalid SQL string.';
	const ROW_COUNT_ERROR			= 'Get Row Count - Error occurred.';
	const ROW_COUNT_STATEMENT		= 'Get Row Count - Missing or invalid statement.';
}

?>