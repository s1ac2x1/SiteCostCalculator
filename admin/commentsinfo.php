<?php
// EziScript configuration for Table comments
$comments = new ccomments; // Initialize table object
// Define table class
class ccomments {
	// Define table level constants
	var $TableVar;
	var $TableName;
	var $SelectLimit = FALSE;
	var $id;
	var $email;
	var $name;
	var $comment;
	var $time;
	var $domain;
	var $id_2;
	var $fields = array();
	function __construct() {
		$this->TableVar = "comments";
		$this->TableName = "comments";
		$this->SelectLimit = TRUE;
		$this->id = new cField('comments', 'x_id', 'id', "`id`", 3, -1, FALSE);
		$this->fields['id'] =& $this->id;
		$this->email = new cField('comments', 'x_email', 'email', "`email`", 200, -1, FALSE);
		$this->fields['email'] =& $this->email;
		$this->name = new cField('comments', 'x_name', 'name', "`name`", 200, -1, FALSE);
		$this->fields['name'] =& $this->name;
		$this->comment = new cField('comments', 'x_comment', 'comment', "`comment`", 201, -1, FALSE);
		$this->fields['comment'] =& $this->comment;
		$this->time = new cField('comments', 'x_time', 'time', "`time`", 200, -1, FALSE);
		$this->fields['time'] =& $this->time;
		$this->domain = new cField('comments', 'x_domain', 'domain', "`domain`", 201, -1, FALSE);
		$this->fields['domain'] =& $this->domain;
		$this->id_2 = new cField('comments', 'x_id_2', 'id_2', "`id_2`", 3, -1, FALSE);
		$this->fields['id_2'] =& $this->id_2;
	}
	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}
	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}
	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}
	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}
	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}
	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}
	// Basic search Keyword
	function getBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}
	function setBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}
	// Basic Search Type
	function getBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}
	function setBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}
	// Search where clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}
	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}
	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}
	// Session WHERE Clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}
	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}
	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}
	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}
	// Session Key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}
	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}
	// Table level SQL
	function SqlSelect() { // Select
		return "SELECT * FROM `comments`";
	}
	function SqlWhere() { // Where
		return "";
	}
	function SqlGroupBy() { // Group By
		return "";
	}
	function SqlHaving() { // Having
		return "";
	}
	function SqlOrderBy() { // Order By
		return "";
	}
	// SQL variables
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type
	// Report table sql
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}
	// Return table sql with list page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		if ($this->CurrentFilter <> "") {
			if ($sFilter <> "") $sFilter .= " AND ";
			$sFilter .= $this->CurrentFilter;
		}
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}
	// Return record count
	function SelectRecordCount() {
		global $conn;
		$cnt = -1;
		$sFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		if ($this->SelectLimit) {
			$sSelect = $this->SelectSQL();
			if (strtoupper(substr($sSelect, 0, 13)) == "SELECT * FROM") {
				$sSelect = "SELECT COUNT(*) FROM" . substr($sSelect, 13);
				if ($rs = $conn->Execute($sSelect)) {
					if (!$rs->EOF) $cnt = $rs->fields[0];
					$rs->Close();
				}
			}
		}
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $sFilter;
		return intval($cnt);
	}
	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= (is_null($value) ? "NULL" : ew_QuotedValue($value, $this->fields[$name]->FldDataType)) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `comments` ($names) VALUES ($values)";
	}
	// UPDATE statement
	function UpdateSQL(&$rs) {
		$SQL = "UPDATE `comments` SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=" .
					(is_null($value) ? "NULL" : ew_QuotedValue($value, $this->fields[$name]->FldDataType)) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}
	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `comments` WHERE ";
		$SQL .= EW_DB_QUOTE_START . 'id_2' . EW_DB_QUOTE_END . '=' .	ew_QuotedValue($rs['id_2'], $this->id_2->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}
	// Key filter for table
	function SqlKeyFilter() {
		return "`id_2` = @id_2@";
	}
	// Return url
	function getReturnUrl() {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] <> "") {
			return $_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL];
		} else {
			return "commentslist.php";
		}
	}
	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}
	// View url
	function ViewUrl() {
		return $this->KeyUrl("commentsview.php");
	}
	// Edit url
	function EditUrl() {
		return $this->KeyUrl("commentsedit.php");
	}
	// Inline edit url
	function InlineEditUrl() {
		return $this->KeyUrl("commentslist.php", "a=edit");
	}
	// Copy url
	function CopyUrl() {
		return $this->KeyUrl("commentsadd.php");
	}
	// Inline copy url
	function InlineCopyUrl() {
		return $this->KeyUrl("commentslist.php", "a=copy");
	}
	// Delete url
	function DeleteUrl() {
		return $this->KeyUrl("commentsdelete.php");
	}
	// Key url
	function KeyUrl($url, $action = "") {
		$sUrl = $url . "?";
		if ($action <> "") $sUrl .= $action . "&";
		if (!is_null($this->id_2->CurrentValue)) {
			$sUrl .= "id_2=" . urlencode($this->id_2->CurrentValue);
		} else {
			return "javascript:alert('Invalid Record! Key is null');";
		}
		return $sUrl;
	}
	// Function LoadRs
	// - Load Row based on Key Value
	function LoadRs($sFilter) {
		global $conn;
		// Set up filter (Sql Where Clause) and get Return Sql
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		return $conn->Execute($sSql);
	}
	// Load row values from rs
	function LoadListRowValues(&$rs) {
		$this->id->setDbValue($rs->fields('id'));
		$this->email->setDbValue($rs->fields('email'));
		$this->name->setDbValue($rs->fields('name'));
		$this->comment->setDbValue($rs->fields('comment'));
		$this->time->setDbValue($rs->fields('time'));
		$this->domain->setDbValue($rs->fields('domain'));
		$this->id_2->setDbValue($rs->fields('id_2'));
	}
	// Render list row values
	function RenderListRow() {
		global $conn, $Security;
		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->CssStyle = "";
		$this->id->CssClass = "";
		$this->id->ViewCustomAttributes = "";
		// email
		$this->email->ViewValue = $this->email->CurrentValue;
		$this->email->CssStyle = "";
		$this->email->CssClass = "";
		$this->email->ViewCustomAttributes = "";
		// name
		$this->name->ViewValue = $this->name->CurrentValue;
		$this->name->CssStyle = "";
		$this->name->CssClass = "";
		$this->name->ViewCustomAttributes = "";
		// comment
		$this->comment->ViewValue = $this->comment->CurrentValue;
		if (!is_null($this->comment->ViewValue)) $this->comment->ViewValue = str_replace("\n", "<br>", $this->comment->ViewValue); 
		$this->comment->CssStyle = "";
		$this->comment->CssClass = "";
		$this->comment->ViewCustomAttributes = "";
		// time
		$this->time->ViewValue = $this->time->CurrentValue;
		$this->time->CssStyle = "";
		$this->time->CssClass = "";
		$this->time->ViewCustomAttributes = "";
		// domain
		$this->domain->ViewValue = $this->domain->CurrentValue;
		if (!is_null($this->domain->ViewValue)) $this->domain->ViewValue = str_replace("\n", "<br>", $this->domain->ViewValue); 
		$this->domain->CssStyle = "";
		$this->domain->CssClass = "";
		$this->domain->ViewCustomAttributes = "";
		// id_2
		$this->id_2->ViewValue = $this->id_2->CurrentValue;
		$this->id_2->CssStyle = "";
		$this->id_2->CssClass = "";
		$this->id_2->ViewCustomAttributes = "";
		// id
		$this->id->HrefValue = "";
		// email
		$this->email->HrefValue = "";
		// name
		$this->name->HrefValue = "";
		// comment
		$this->comment->HrefValue = "";
		// time
		$this->time->HrefValue = "";
		// domain
		$this->domain->HrefValue = "";
		// id_2
		$this->id_2->HrefValue = "";
	}
	var $CurrentAction; // Current action
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message
	var $RowType; // Row Type
	var $CssClass; // Css class
	var $CssStyle; // Css style
	var $RowClientEvents; // Row client events
	// Display Attribute
	function DisplayAttributes() {
		$sAtt = "";
		if (trim($this->CssStyle) <> "") {
			$sAtt .= " style=\"" . trim($this->CssStyle) . "\"";
		}
		if (trim($this->CssClass) <> "") {
			$sAtt .= " class=\"" . trim($this->CssClass) . "\"";
		}
		if ($this->Export == "") {
			if (trim($this->RowClientEvents) <> "") {
				$sAtt .= " " . $this->RowClientEvents;
			}
		}
		return $sAtt;
	}
	// Export
	var $Export;
//	 ----------------
//	  Field objects
//	 ----------------
	function fields($fldname) {
		return $this->fields[$fldname];
	}
	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {
		// Enter your code here	
	}
	// Recordset Selected event
	function Recordset_Selected(&$rs) {
		//echo "Recordset Selected";
	}
	// Row_Selecting event
	function Row_Selecting(&$filter) {
		// Enter your code here	
	}
	// Row Selected event
	function Row_Selected(&$rs) {
		//echo "Row Selected";
	}
	// Row Rendering event
	function Row_Rendering() {
		// Enter your code here	
	}
	// Row Rendered event
	function Row_Rendered() {
		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 
	}
	// Row Inserting event
	function Row_Inserting(&$rs) {
		// Enter your code here
		// To cancel, set return value to False
		return TRUE;
	}
	// Row Inserted event
	function Row_Inserted(&$rs) {
		//echo "Row Inserted";
	}
	// Row Updating event
	function Row_Updating(&$rsold, &$rsnew) {
		// Enter your code here
		// To cancel, set return value to False
		return TRUE;
	}
	// Row Updated event
	function Row_Updated(&$rsold, &$rsnew) {
		//echo "Row Updated";
	}
	// Row Deleting event
	function Row_Deleting($rs) {
		// Enter your code here
		// To cancel, set return value to False
		return TRUE;
	}
	// Row Deleted event
	function Row_Deleted(&$rs) {
		//echo "Row Deleted";
	}
}
?>
