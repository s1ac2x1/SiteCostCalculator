<?php
define("EW_PAGE_ID", "add", TRUE); // Page ID
define("EW_TABLE_NAME", 'filter', TRUE);
?>
<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg50.php" ?>
<?php include "ewmysql50.php" ?>
<?php include "phpfn50.php" ?>
<?php include "filterinfo.php" ?>
<?php include "userfn50.php" ?>
<?php include "admininfo.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Open connection to the database
$conn = ew_Connect();
?>
<?php
$Security = new cAdvancedSecurity();
?>
<?php
if (!$Security->IsLoggedIn()) $Security->AutoLogin();
if (!$Security->IsLoggedIn()) {
	$Security->SaveLastUrl();
	Page_Terminate("login.php");
}
?>
<?php

// Common page loading event (in userfn*.php)
Page_Loading();
?>
<?php

// Page load event, used in current page
Page_Load();
?>
<?php
$filter->Export = @$_GET["export"]; // Get export parameter
$sExport = $filter->Export; // Get export parameter, used in header
$sExportFile = $filter->TableVar; // Get export file, used in header
?>
<?php

// Load key values from QueryString
$bCopy = TRUE;
if (@$_GET["domainname"] != "") {
  $filter->domainname->setQueryStringValue($_GET["domainname"]);
} else {
  $bCopy = FALSE;
}

// Create form object
$objForm = new cFormObj();

// Process form if post back
if (@$_POST["a_add"] <> "") {
  $filter->CurrentAction = $_POST["a_add"]; // Get form action
  LoadFormValues(); // Load form values
} else { // Not post back
  if ($bCopy) {
    $filter->CurrentAction = "C"; // Copy Record
  } else {
    $filter->CurrentAction = "I"; // Display Blank Record
    LoadDefaultValues(); // Load default values
  }
}

// Perform action based on action code
switch ($filter->CurrentAction) {
  case "I": // Blank record, no action required
		break;
  case "C": // Copy an existing record
   if (!LoadRow()) { // Load record based on key
      $_SESSION[EW_SESSION_MESSAGE] = "No records found"; // No record found
      Page_Terminate($filter->getReturnUrl()); // Clean up and return
    }
		break;
  case "A": // ' Add new record
		$filter->SendEmail = TRUE; // Send email on add success
    if (AddRow()) { // Add successful
      $_SESSION[EW_SESSION_MESSAGE] = "Add New Record Successful"; // Set up success message
      Page_Terminate($filter->KeyUrl($filter->getReturnUrl())); // Clean up and return
    } else {
      RestoreFormValues(); // Add failed, restore form values
    }
}

// Render row based on row type
$filter->RowType = EW_ROWTYPE_ADD;  // Render add type
RenderRow();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--
var EW_PAGE_ID = "add"; // Page id

//-->
</script>
<script type="text/javascript">
<!--

function ew_ValidateForm(fobj) {
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_domainname"];
		if (elm && !ew_HasValue(elm)) {
			if (!ew_OnError(elm, "Please enter required field - domainname"))
				return false;
		}
	}
	return true;
}

//-->
</script>
<script type="text/javascript">
<!--

// js for DHtml Editor
//-->

</script>
<script type="text/javascript">
<!--

// js for Popup Calendar
//-->

</script>
<script type="text/javascript">
<!--
var ew_MultiPagePage = "Page"; // multi-page Page Text
var ew_MultiPageOf = "of"; // multi-page Of Text
var ew_MultiPagePrev = "Prev"; // multi-page Prev Text
var ew_MultiPageNext = "Next"; // multi-page Next Text

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="EziScript">Add to TABLE: Website Info<br><br><a href="<?php echo $filter->getReturnUrl() ?>">Go Back</a></span></p>
<?php
if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Mesasge in Session, display
?>
<p><span class="ewmsg"><?php echo $_SESSION[EW_SESSION_MESSAGE] ?></span></p>
<?php
  $_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
}
?>
<form name="ffilteradd" id="ffilteradd" action="filteradd.php" method="post" onSubmit="return ew_ValidateForm(this);">
<p>
<input type="hidden" name="a_add" id="a_add" value="A">
<table class="ewTable">
  <tr class="ewTableRow">
    <td class="ewTableHeader">domainname<span class='ewmsg'>&nbsp;*</span></td>
    <td<?php echo $filter->domainname->CellAttributes() ?>><span id="cb_x_domainname">
<textarea name="x_domainname" id="x_domainname" cols="35" rows="4"<?php echo $filter->domainname->EditAttributes() ?>><?php echo $filter->domainname->EditValue ?></textarea>
</span></td>
  </tr>
</table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="    Add    ">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php

// If control is passed here, simply terminate the page without redirect
Page_Terminate();

// -----------------------------------------------------------------
//  Subroutine Page_Terminate
//  - called when exit page
//  - clean up connection and objects
//  - if url specified, redirect to url, otherwise end response
function Page_Terminate($url = "") {
	global $conn;

	// Page unload event, used in current page
	Page_Unload();

	// Global page unloaded event (in userfn*.php)
	Page_Unloaded();

	 // Close Connection
	$conn->Close();

	// Go to url if specified
	if ($url <> "") {
		ob_end_clean();
		header("Location: $url");
	}
	exit();
}
?>
<?php

// Load default values
function LoadDefaultValues() {
	global $filter;
}
?>
<?php

// Load form values
function LoadFormValues() {

	// Load from form
	global $objForm, $filter;
	$filter->domainname->setFormValue($objForm->GetValue("x_domainname"));
}

// Restore form values
function RestoreFormValues() {
	global $filter;
	$filter->domainname->CurrentValue = $filter->domainname->FormValue;
}
?>
<?php

// Load row based on key values
function LoadRow() {
	global $conn, $Security, $filter;
	$sFilter = $filter->SqlKeyFilter();
	$sFilter = str_replace("@domainname@", ew_AdjustSql($filter->domainname->CurrentValue), $sFilter); // Replace key value

	// Call Row Selecting event
	$filter->Row_Selecting($sFilter);

	// Load sql based on filter
	$filter->CurrentFilter = $sFilter;
	$sSql = $filter->SQL();
	if ($rs = $conn->Execute($sSql)) {
		if ($rs->EOF) {
			$LoadRow = FALSE;
		} else {
			$LoadRow = TRUE;
			$rs->MoveFirst();
			LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$filter->Row_Selected($rs);
		}
		$rs->Close();
	} else {
		$LoadRow = FALSE;
	}
	return $LoadRow;
}

// Load row values from recordset
function LoadRowValues(&$rs) {
	global $filter;
	$filter->domainname->setDbValue($rs->fields('domainname'));
}
?>
<?php

// Render row values based on field settings
function RenderRow() {
	global $conn, $Security, $filter;

	// Call Row Rendering event
	$filter->Row_Rendering();

	// Common render codes for all row types
	// domainname

	$filter->domainname->CellCssStyle = "";
	$filter->domainname->CellCssClass = "";
	if ($filter->RowType == EW_ROWTYPE_VIEW) { // View row
	} elseif ($filter->RowType == EW_ROWTYPE_ADD) { // Add row

		// domainname
		$filter->domainname->EditCustomAttributes = "";
		$filter->domainname->EditValue = ew_HtmlEncode($filter->domainname->CurrentValue);
	} elseif ($filter->RowType == EW_ROWTYPE_EDIT) { // Edit row
	} elseif ($filter->RowType == EW_ROWTYPE_SEARCH) { // Search row
	}

	// Call Row Rendered event
	$filter->Row_Rendered();
}
?>
<?php

// Add record
function AddRow() {
	global $conn, $Security, $filter;

	// Check for duplicate key
	$bCheckKey = TRUE;
	$sFilter = $filter->SqlKeyFilter();
	if (trim(strval($filter->domainname->CurrentValue)) == "") {
		$bCheckKey = FALSE;
	} else {
		$sFilter = str_replace("@domainname@", ew_AdjustSql($filter->domainname->CurrentValue), $sFilter); // Replace key value
	}
	if ($bCheckKey) {
		$rsChk = $filter->LoadRs($sFilter);
		if ($rsChk && !$rsChk->EOF) {
			$_SESSION[EW_SESSION_MESSAGE] = "Duplicate value for primary key";
			$rsChk->Close();
			return FALSE;
		}
	}
	$rsnew = array();

	// Field domainname
	$filter->domainname->SetDbValueDef($filter->domainname->CurrentValue, "");
	$rsnew['domainname'] =& $filter->domainname->DbValue;

	// Call Row Inserting event
	$bInsertRow = $filter->Row_Inserting($rsnew);
	if ($bInsertRow) {
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$AddRow = $conn->Execute($filter->InsertSQL($rsnew));
		$conn->raiseErrorFn = '';
	} else {
		if ($filter->CancelMessage <> "") {
			$_SESSION[EW_SESSION_MESSAGE] = $filter->CancelMessage;
			$filter->CancelMessage = "";
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = "Insert cancelled";
		}
		$AddRow = FALSE;
	}
	if ($AddRow) {

		// Call Row Inserted event
		$filter->Row_Inserted($rsnew);
	}
	return $AddRow;
}
?>
<?php

// Page Load event
function Page_Load() {

	//echo "Page Load";
}

// Page Unload event
function Page_Unload() {

	//echo "Page Unload";
}
?>