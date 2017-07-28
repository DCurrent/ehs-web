<?php

	$cQueQuantityLst			= NULL;	//Values to generate question quantity select box.
	$cClassID					= NULL;	
	$bParams					= NULL;	//Module parameter booloean value array.
	$params					= NULL;	//Module parameter string/numeric value array.
	$value 						= NULL;	//Loop array value placeholder.
	
	/* Convert true/false values to boolean. */			
	foreach ($bClassParams as &$value)
	{		
		if ($value)
		{			
			$value = 1;
		}
		else
		{
			$value = 0;
		}
	} 
	unset($value);
		
	/* Get selected class ID. */
	$params['class_id'] = $utl->utl_get_post('cClassID');
	
	/* Locate module using selected class ID and get info. */
	$query = "SELECT 
						* 
	FROM 				tbl_class_train_parameters 
	WHERE     			quiz_id 	= ?";
	
	$oDB->db_basic_select($query, array(&$cClassID), TRUE);	
	$params = $oDB->DBLine;
	
	$params['id']	= $oDB->DBLine['id'];
	
	
	/* Populate question parameters quantity list. */			
	$query = "SELECT 
				guid_id
	FROM 		tbl_class_train_questions
	WHERE		fk_id = ?";
	
	$params = array(&$params['id']);			
	
	$cQueQuantityLst = $oDL->dl_numeric($query, $params, "ALL", $cClassQQuantity, TRUE, 1, array("None" => 0, "All" => ""));
	

?>

Click <a href="../main.php?cClassID=<?php echo $params['class_id']; ?>" target="_blank">here</a> to view module.
<br /><br />

<div id="parameters">
    <form action="<?php $_SERVER['../PHP_SELF']; ?>" method="post" entype="multipart/form-data" name="class_parameters" id="form">
        <input type="hidden" name="cClassID" value="<?php echo $cClassID; ?>" />							
        
        <table width="100%" height="84" border="0" cellpadding="2" cellspacing="0" bgcolor="#F0F0FF">
            <tr>
            	<th colspan="2">
					<?php echo $cClassTitle; ?> Parameters
                </th>
            </tr>
            <tr bgcolor="#DDDDFF">
                <td width="36%">Access</td>
                <td width="64%">
                    <input type="radio" name="bClassSetHidden" id="bClassSetHidden0" value=0 /><label for="bClassSetHidden">Public</label>
                    <input type="radio" name="bClassSetHidden" id="bClassSetHidden1" value=1 /><label for="bClassSetHidden">Hidden</label>
                    <input type="radio" name="bClassSetHidden" id="bClassSetHidden2" value=2 checked="checked" /><label for="bClassSetHidden">Restricted</label>
                    <input type="radio" name="bClassSetHidden" id="bClassSetHidden1" value=3 /><label for="bClassSetHidden">In person only</label>
                </td>
            </tr>
            <tr>
            	<td>
                	Question Order
                </td>
            	<td>
                    <label><input name="cClassQOrder" type="radio" id="cClassQOrder0" value=0 checked="checked"/>Linear</label>
                    <label><input name="cClassQOrder" type="radio" id="cClassQOrder1" value=1/>Manual</label>	
                    <label><input name="cClassQOrder" type="radio" id="cClassQOrder2" value=2/>Random</label>
            	</td>
            </tr>
            <tr bgcolor="#DDDDFF">
            	<td>
                	Question Layout
                </td>
            
            	<td>
                    <label><input name="cClassQLayout" type="radio" id="cClassQLayout0" value=0 checked="checked"/>List</label>
                    <label><input name="cClassQLayout" type="radio" id="cClassQLayout1" value=1/>Paged</label>
            	</td>
            </tr>
            <tr>
            	<td>
                	Question Quantity
                </td>
                <td>
                	<select name='frm_lst_cClassQQuantity' id='frm_lst_cClassQQuantity'><?php echo $cQueQuantityLst; ?></select>
                </td>
            </tr>
            <tr bgcolor="#DDDDFF">
            	<td>
                	Registration Fields
            	</td>
            	<td>
                    <input type="checkbox" name="bClassFieldComments" id="form_check" <?php echo $bParams['bClassFieldComments']; ?> />
                    <label for="form_check_label">Comments</label>
                
                    <input type="checkbox" name="bClassFieldFacility" id="form_check" <?php echo  $bParams['bClassFieldFacility']; ?> />
                    <label for="form_check_label">Facility/Room</label>
                    
                    <input type="checkbox" name="bClassFieldAddroom" id="form_check" <?php echo  $bParams['bClassFieldAddroom']; ?> />
                    <label for="form_check_label">Additional Labs/Rooms</label>
                    
                    <input type="checkbox" name="bClassFieldDept" id="form_check" <?php echo  $bParams['bClassFieldDept']; ?> />
                    <label for="form_check_label">Department</label>
                    
                    <input type="checkbox" name="bClassFieldMail" id="form_check" <?php echo  $bParams['bClassFieldMail']; ?> />
                    <label for="form_check_label">Mail</label>
                    
                    <input type="checkbox" name="bClassFieldEMail" id="form_check" <?php echo  $bParams['bClassFieldEMail']; ?> />
                    <label for="form_check_label">E-Mail</label>
                    
                    <input type="checkbox" name="bClassFieldTStatus" id="form_check" <?php echo  $bParams['bClassFieldTStatus']; ?> />
                    <label for="form_check_label">Training Status</label>
                    
                    <input type="checkbox" name="bClassFieldETrax" id="form_check" <?php echo  $bParams['bClassFieldETrax']; ?> />
                    <label for="form_check_label">Request Etrax</label>
                    
                    <input type="checkbox" name="bClassFieldUKStatus" id="form_check" <?php echo  $bParams['bClassFieldUKStatus']; ?> />
                    <label for="form_check_label">UK Status</label>
                    
                    <input type="checkbox" name="bClassFieldUKID" id="form_check" <?php echo  $bParams['bClassFieldUKID']; ?> />
                    <label for="form_check_label">UK ID</label>
                    
                    <input type="checkbox" name="bClassFieldSuper" id="form_check" <?php echo  $bParams['bClassFieldSuper']; ?> />
                    <label for="form_check_label">PI/Supervisor</label>
                    
                    <input type="checkbox" name="bClassFieldPhone" id="form_check" <?php echo  $bParams['bClassFieldPhone']; ?> />
                    <label for="form_check_label">Phone</label>                
                </td>
            </tr>    
            <tr>
                <td>
                	Email List
            	</td>
                <td>
                	<textarea name="cClassEmail" rows="2" id="form_memo"><?php echo $params['cClassEmail']; ?></textarea>
                </td>
            </tr>                    
            <tr bgcolor="#DDDDFF">
            	<td>
                	Introduction
            	</td>
            	<td>
                	<textarea name="cClassIntro" rows="4" id="form_memo"><?php echo $params['cClassIntro']; ?></textarea>
            	</td>
            </tr>
            <tr>
            	<td>
                	Material Above (Header)
            	</td>
            	<td>
                	<textarea name="cClassMaterialAboveHead" rows="2" id="form_memo"><?php echo $params['cClassMaterialAboveHead']; ?></textarea>
                </td>
            </tr>	
            <tr bgcolor="#DDDDFF">
            	<td>
                	Material Above
                </td>
                <td>
                    <textarea name="cClassMaterialAbove" rows="4" id="form_memo"><?php echo $params['cClassMaterialAbove']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td>
                	Instructions (Header)
                </td>
                <td>
                	<textarea name="cClassInstrHead" rows="2" id="form_memo"><?php echo $params['cClassInstrHead']; ?></textarea>
                </td>
            </tr>	
            <tr bgcolor="#DDDDFF">
            	<td>
                	Instructions
            	</td>
            	<td>
                	<textarea name="cClassInstr" rows="8" id="form_memo"><?php echo $params['cClassInstr']; ?></textarea>
            	</td>
            </tr>	
            <tr>
                <td>
                	Material Below (Header)
            	</td>
                <td>
                	<textarea name="cClassMaterialBelowHead" rows="2" id="form_memo"><?php echo $params['cClassMaterialBelowHead']; ?></textarea>
            	</td>
            </tr>	
            <tr bgcolor="#DDDDFF">
            	<td>
                	Material Below
            	</td>
            	<td>
                	<textarea name="cClassMaterialBelow" rows="4" id="form_memo"><?php echo $params['cClassMaterialBelow']; ?></textarea>
            	</td>
            </tr>
            
            <tr>
            	<td>
                	Certificate (Responsible Party)
            	</td>
                <td>
                    <select name="frm_lst_cClassCertParty" id="form_memo"><?php echo $cResponsiblePartyLst; ?></select>
                </td>
            </tr> 
            <tr bgcolor="#DDDDFF">
            	<td>
                	Certificate (Verbiage)
            	</td>
            	<td>
                	<textarea name="cClassCertVerbiage" rows="4" id="form_memo"><?php echo $params['cClassCertVerbiage']; ?></textarea>
            	</td>
            </tr>                                                                         			      
        </table>					
        <p>
        	<input type="submit" name="Save_Parameters" id="form_button" value="Save Parameters" />
        </p>
	</form>
<!--/parameters-->    
</div>
    
<div id="questions">                

    <table width="100%" border="0" cellspacing="0" cellpadding="1">
    	<tr>
    		<th width="100%">
				<?php echo $cClassTitle; ?> Questions
            </th>
    	</tr>
    </table>              
    
    <?php echo $cQuestions;	?>

<!--/questions-->
</div>
    
<div id="access">                
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<th>
            	Access Accounts
            </th>
        </tr>
        <?php echo $cAccounts; ?>
    </table>
    
<!--/access-->               				            
</div>
