<?php 

	// Session keys.
	abstract class SESSION_KEYS
	{
		const	
			MODULE 		= 'ses_training_module',
			QUESTION	= 'ses_training_question',
			A_UPDATES	= 'ses_training_answer_updates';
	}

	// Submit commands
	abstract class COMMANDS
	{
		const 
			QUESTIONS 	= 1,
			SAVE		= 2;
	}

	// General use constants.
	abstract class CONSTANTS
	{
		const
			TITLE_LENGTH = 30;
		
		const 
			SAVE_MAIN = TRUE;
		
		const 
			QUANTITY = 15;		
		
		const
			NO 	= 0,
			YES	= 1;		
	}	

	// IDs for modules without a database indentifier.
	abstract class ITEM_ID
	{
		const
			FRESH 	= -1,	// New module
			NONE	= 0;	// No module selected.
	}
	
	abstract class MODULE_ACCESS
	{
		const
			OPEN 		= 1,	// Open to all users with valid login.
			HIDDEN 		= 2,	// Hidden from view but still accessable.
			RESTRICTED	= 3,	// Restricted to list of accounts.
			LOCKED		= 4;	// May only be accessed by administrator or responsible party.
	}
	
	// Order of questions as presented to user.
	abstract class QUESTION_ORDER
	{
		const
			LINEAR = 0,
			//MANUAL = 1,
			RANDOM = 2;
	}
	
	abstract class QUESTION_LAYOUT
	{
		const
			LISTED 	= 0,
			PAGED 	= 1;
	}
	
	// Order of questions as presented to user.
	abstract class FIELD_LIST
	{
		const
			LINEAR = 0,
			//MANUAL = 1,
			RANDOM = 2;
	}
	
	abstract class FIELD_TOGGLE_LIST
	{
		const 
			FIELD_COMMENTS	= 'Comments',
			FIELD_ADDROOM	= 'Addtional Room/Lab',
			FIELD_MAIL		= 'Mail',
			FIELD_EMAIL		= 'E-Mail';			
	}
	
?>