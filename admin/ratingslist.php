<?php
define("EW_PAGE_ID", "list", TRUE); // Page ID
define("EW_TABLE_NAME", 'ratings', TRUE);
?>
<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg50.php" ?>
<?php include "ewmysql50.php" ?>
<?php include "phpfn50.php" ?>
<?php include "ratingsinfo.php" ?>
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
$ratings->Export = @$_GET["export"]; // Get export parameter
$sExport = $ratings->Export; // Get export parameter, used in header
$sExportFile = $ratings->TableVar; // Get export file, used in header
?>
<?php
if ($ratings->Export == "excel") {
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename=' . $sExportFile .'.xls');
}
if ($ratings->Export == "word") {
	header('Content-Type: application/vnd.ms-word');
	header('Content-Disposition: attachment; filename=' . $sExportFile .'.doc');
}
if ($ratings->Export == "csv") {
	header('Content-Type: application/csv');
	header('Content-Disposition: attachment; filename=' . $sExportFile .'.csv');
}
?>
<?php

// Paging variables
$nStartRec = 0; // Start record index
$nStopRec = 0; // Stop record index
$nTotalRecs = 0; // Total number of records
$nDisplayRecs = 20;
$nRecRange = 10;
$nRecCount = 0; // Record count

// Search filters
$sSrchAdvanced = ""; // Advanced search filter
$sSrchBasic = ""; // Basic search filter
$sSrchWhere = ""; // Search where clause
$sFilter = "";

// Master/Detail
$sDbMasterFilter = ""; // Master filter
$sDbDetailFilter = ""; // Detail filter
$sSqlMaster = ""; // Sql for master record

// Handle reset command
ResetCmd();

// Get basic search criteria
$sSrchBasic = BasicSearchWhere();

// Build search criteria
if ($sSrchAdvanced <> "") {
	if ($sSrchWhere <> "") $sSrchWhere .= " AND ";
	$sSrchWhere .= "(" . $sSrchAdvanced . ")";
}
if ($sSrchBasic <> "") {
	if ($sSrchWhere <> "") $sSrchWhere .= " AND ";
	$sSrchWhere .= "(" . $sSrchBasic . ")";
}

// Save search criteria
if ($sSrchWhere <> "") {
	if ($sSrchBasic == "") ResetBasicSearchParms();
	$ratings->setSearchWhere($sSrchWhere); // Save to Session
	$nStartRec = 1; // Reset start record counter
	$ratings->setStartRecordNumber($nStartRec);
} else {
	RestoreSearchParms();
}

// Build filter
$sFilter = "";
if ($sDbDetailFilter <> "") {
	if ($sFilter <> "") $sFilter .= " AND ";
	$sFilter .= "(" . $sDbDetailFilter . ")";
}
if ($sSrchWhere <> "") {
	if ($sFilter <> "") $sFilter .= " AND ";
	$sFilter .= "(" . $sSrchWhere . ")";
}

// Set up filter in Session
$ratings->setSessionWhere($sFilter);
$ratings->CurrentFilter = "";

// Set Up Sorting Order
SetUpSortOrder();

// Export data only
if ($ratings->Export == "xml" || $ratings->Export == "csv") {
	ExportData();
	Page_Terminate(); // Terminate response
}

// Set Return Url
$ratings->setReturnUrl("ratingslist.php");
?>
<?php include "header.php" ?>
<?php if ($ratings->Export == "") { ?>
<script type="text/javascript">
<!--
var EW_PAGE_ID = "list"; // Page id

//-->
</script>
<script type="text/javascript">
<!--
var firstrowoffset = 1; // First data row start at
var lastrowoffset = 0; // Last data row end at
var EW_LIST_TABLE_NAME = 'ewlistmain'; // Table name for list page
var rowclass = 'ewTableRow'; // Row class
var rowaltclass = 'ewTableAltRow'; // Row alternate class
var rowmoverclass = 'ewTableHighlightRow'; // Row mouse over class
var rowselectedclass = 'ewTableSelectRow'; // Row selected class
var roweditclass = 'ewTableEditRow'; // Row edit class

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

function ew_SelectKey(elem) {
	var f = elem.form;	
	if (!f.elements["key_m[]"]) return;
	if (f.elements["key_m[]"][0]) {
		for (var i=0; i<f.elements["key_m[]"].length; i++)
			f.elements["key_m[]"][i].checked = elem.checked;	
	} else {
		f.elements["key_m[]"].checked = elem.checked;	
	}
	ew_ClickAll(elem);
}

function ew_Selected(f) {
	if (!f.elements["key_m[]"]) return false;
	if (f.elements["key_m[]"][0]) {
		for (var i=0; i<f.elements["key_m[]"].length; i++)
			if (f.elements["key_m[]"][i].checked) return true;
	} else {
		return f.elements["key_m[]"].checked;
	}
	return false;
}

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($ratings->Export == "") { ?>
<?php } ?>
<?php

// Load recordset
$bExportAll = (defined("EW_EXPORT_ALL") && $ratings->Export <> "");
$bSelectLimit = ($ratings->Export == "" && $ratings->SelectLimit);
if (!$bSelectLimit) $rs = LoadRecordset();
$nTotalRecs = ($bSelectLimit) ? $ratings->SelectRecordCount() : $rs->RecordCount();
$nStartRec = 1;
if ($nDisplayRecs <= 0) $nDisplayRecs = $nTotalRecs; // Display all records
if (!$bExportAll) SetUpStartRec(); // Set up start record position
if ($bSelectLimit) $rs = LoadRecordset($nStartRec-1, $nDisplayRecs);
?>
<p><span class="EziScript" style="white-space: nowrap;">TABLE: Webiste Rating
<?php if ($ratings->Export == "") { ?>
&nbsp;&nbsp;<a href="ratingslist.php?export=excel">Export to Excel</a>
&nbsp;&nbsp;<a href="ratingslist.php?export=word">Export to Word</a>
&nbsp;&nbsp;<a href="ratingslist.php?export=csv">Export to CSV</a>
<?php } ?>
</span></p>
<?php if ($ratings->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<form name="fratingslistsrch" id="fratingslistsrch" action="ratingslist.php" >
<table class="ewBasicSearch">
	<tr>
		<td><span class="EziScript">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($ratings->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<a href="ratingslist.php?cmd=reset">Show all</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="EziScript"><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="" <?php if ($ratings->getBasicSearchType() == "") { ?>checked<?php } ?>>Exact phrase&nbsp;&nbsp;<input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND" <?php if ($ratings->getBasicSearchType() == "AND") { ?>checked<?php } ?>>All words&nbsp;&nbsp;<input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR" <?php if ($ratings->getBasicSearchType() == "OR") { ?>checked<?php } ?>>Any word</span></td>
	</tr>
</table>
</form>
<?php } ?>
<?php } ?>
<?php
if (@$_SESSION[EW_SESSION_MESSAGE] <> "") {
?>
<p><span class="ewmsg"><?php echo $_SESSION[EW_SESSION_MESSAGE] ?></span></p>
<?php
	$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message
}
?>
<?php if ($ratings->Export == "") { ?>
<form action="ratingslist.php" name="ewpagerform" id="ewpagerform">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td nowrap>
<?php if (!isset($Pager)) $Pager = new cPrevNextPager($nStartRec, $nDisplayRecs, $nTotalRecs) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="EziScript">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="ratingslist.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="ratingslist.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="ratingslist.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="ratingslist.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="EziScript">&nbsp;of <?php echo $Pager->PageCount ?></span></td>
	</tr></table>
	<span class="EziScript">Records <?php echo $Pager->FromIndex ?> to <?php echo $Pager->ToIndex ?> of <?php echo $Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($sSrchWhere == "0=101") { ?>
	<span class="EziScript">Please enter search criteria</span>
	<?php } else { ?>
	<span class="EziScript">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<form method="post" name="fratingslist" id="fratingslist">
<?php if ($ratings->Export == "") { ?>
<table>
	<tr><td><span class="EziScript">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="ratingsadd.php">Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($nTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onClick="if (!ew_Selected(document.fratingslist)) alert('No records selected'); else {document.fratingslist.action='ratingsdelete.php';document.fratingslist.encoding='application/x-www-form-urlencoded';document.fratingslist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
	</span></td></tr>
</table>
<?php } ?>
<?php if ($nTotalRecs > 0) { ?>
<table id="ewlistmain" class="ewTable">
<?php
	$OptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$OptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$OptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$OptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$OptionCnt++; // multi select
}
?>
	<!-- Table header -->
	<tr class="ewTableHeader">
		<td valign="top">
<?php if ($ratings->Export <> "") { ?>
id
<?php } else { ?>
	<a href="ratingslist.php?order=<?php echo urlencode('id') ?>&ordertype=<?php echo $ratings->id->ReverseSort() ?>">id<?php if ($ratings->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ratings->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($ratings->Export <> "") { ?>
rating
<?php } else { ?>
	<a href="ratingslist.php?order=<?php echo urlencode('rating') ?>&ordertype=<?php echo $ratings->rating->ReverseSort() ?>">rating<?php if ($ratings->rating->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ratings->rating->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($ratings->Export <> "") { ?>
domain
<?php } else { ?>
	<a href="ratingslist.php?order=<?php echo urlencode('domain') ?>&ordertype=<?php echo $ratings->domain->ReverseSort() ?>">domain&nbsp;(*)<?php if ($ratings->domain->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ratings->domain->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($ratings->Export <> "") { ?>
id 2
<?php } else { ?>
	<a href="ratingslist.php?order=<?php echo urlencode('id_2') ?>&ordertype=<?php echo $ratings->id_2->ReverseSort() ?>">id 2<?php if ($ratings->id_2->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ratings->id_2->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
<?php if ($ratings->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap>&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap>&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap>&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap><input type="checkbox" class="EziScript" onClick="ew_SelectKey(this);"></td>
<?php } ?>
<?php } ?>
	</tr>
<?php
if (defined("EW_EXPORT_ALL") && $ratings->Export <> "") {
	$nStopRec = $nTotalRecs;
} else {
	$nStopRec = $nStartRec + $nDisplayRecs - 1; // Set the last record to display
}
$nRecCount = $nStartRec - 1;
if (!$rs->EOF) {
	$rs->MoveFirst();
	if (!$ratings->SelectLimit) $rs->Move($nStartRec - 1); // Move to first record directly
}
$RowCnt = 0;
while (!$rs->EOF && $nRecCount < $nStopRec) {
	$nRecCount++;
	if (intval($nRecCount) >= intval($nStartRec)) {
		$RowCnt++;

	// Init row class and style
	$ratings->CssClass = "ewTableRow";
	$ratings->CssStyle = "";

	// Init row event
	$ratings->RowClientEvents = "onmouseover='ew_MouseOver(this);' onmouseout='ew_MouseOut(this);' onclick='ew_Click(this);'";

	// Display alternate color for rows
	if ($RowCnt % 2 == 0) {
		$ratings->CssClass = "ewTableAltRow";
	}
	LoadRowValues($rs); // Load row values
	$ratings->RowType = EW_ROWTYPE_VIEW; // Render view
	RenderRow();
?>
	<!-- Table body -->
	<tr<?php echo $ratings->DisplayAttributes() ?>>
		<!-- id -->
		<td<?php echo $ratings->id->CellAttributes() ?>>
<div<?php echo $ratings->id->ViewAttributes() ?>><?php echo $ratings->id->ViewValue ?></div>
</td>
		<!-- rating -->
		<td<?php echo $ratings->rating->CellAttributes() ?>>
<div<?php echo $ratings->rating->ViewAttributes() ?>><?php echo $ratings->rating->ViewValue ?></div>
</td>
		<!-- domain -->
		<td<?php echo $ratings->domain->CellAttributes() ?>>
<div<?php echo $ratings->domain->ViewAttributes() ?>><?php echo $ratings->domain->ViewValue ?></div>
</td>
		<!-- id_2 -->
		<td<?php echo $ratings->id_2->CellAttributes() ?>>
<div<?php echo $ratings->id_2->ViewAttributes() ?>><?php echo $ratings->id_2->ViewValue ?></div>
</td>
<?php if ($ratings->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap><span class="EziScript">
<a href="<?php echo $ratings->ViewUrl() ?>">View</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap><span class="EziScript">
<a href="<?php echo $ratings->EditUrl() ?>">Edit</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap><span class="EziScript">
<a href="<?php echo $ratings->CopyUrl() ?>">Copy</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap><span class="EziScript">
<input type="checkbox" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($ratings->id_2->CurrentValue) ?>" class="EziScript" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php } ?>
	</tr>
<?php
	}
	$rs->MoveNext();
}
?>
</table>
<?php if ($ratings->Export == "") { ?>
<table>
	<tr><td><span class="EziScript">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="ratingsadd.php">Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($nTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onClick="if (!ew_Selected(document.fratingslist)) alert('No records selected'); else {document.fratingslist.action='ratingsdelete.php';document.fratingslist.encoding='application/x-www-form-urlencoded';document.fratingslist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
	</span></td></tr>
</table>
<?php } ?>
<?php } ?>
</form>
<?php

// Close recordset and connection
if ($rs) $rs->Close();
?>
<?php if ($ratings->Export == "") { ?>
<form action="ratingslist.php" name="ewpagerform" id="ewpagerform">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td nowrap>
<?php if (!isset($Pager)) $Pager = new cPrevNextPager($nStartRec, $nDisplayRecs, $nTotalRecs) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="EziScript">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="ratingslist.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="ratingslist.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="ratingslist.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="ratingslist.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="EziScript">&nbsp;of <?php echo $Pager->PageCount ?></span></td>
	</tr></table>
	<span class="EziScript">Records <?php echo $Pager->FromIndex ?> to <?php echo $Pager->ToIndex ?> of <?php echo $Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($sSrchWhere == "0=101") { ?>
	<span class="EziScript">Please enter search criteria</span>
	<?php } else { ?>
	<span class="EziScript">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<?php if ($ratings->Export == "") { ?>
<?php } ?>
<?php if ($ratings->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
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

// Return Basic Search sql
function BasicSearchSQL($Keyword) {
	$sKeyword = ew_AdjustSql($Keyword);
	$sql = "";
	$sql .= "`domain` LIKE '%" . $sKeyword . "%' OR ";
	if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
	return $sql;
}

// Return Basic Search Where based on search keyword and type
function BasicSearchWhere() {
	global $Security, $ratings;
	$sSearchStr = "";
	$sSearchKeyword = ew_StripSlashes(@$_GET[EW_TABLE_BASIC_SEARCH]);
	$sSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	if ($sSearchKeyword <> "") {
		$sSearch = trim($sSearchKeyword);
		if ($sSearchType <> "") {
			while (strpos($sSearch, "  ") !== FALSE)
				$sSearch = str_replace("  ", " ", $sSearch);
			$arKeyword = explode(" ", trim($sSearch));
			foreach ($arKeyword as $sKeyword) {
				if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
				$sSearchStr .= "(" . BasicSearchSQL($sKeyword) . ")";
			}
		} else {
			$sSearchStr = BasicSearchSQL($sSearch);
		}
	}
	if ($sSearchKeyword <> "") {
		$ratings->setBasicSearchKeyword($sSearchKeyword);
		$ratings->setBasicSearchType($sSearchType);
	}
	return $sSearchStr;
}

// Clear all search parameters
function ResetSearchParms() {

	// Clear search where
	global $ratings;
	$sSrchWhere = "";
	$ratings->setSearchWhere($sSrchWhere);

	// Clear basic search parameters
	ResetBasicSearchParms();
}

// Clear all basic search parameters
function ResetBasicSearchParms() {

	// Clear basic search parameters
	global $ratings;
	$ratings->setBasicSearchKeyword("");
	$ratings->setBasicSearchType("");
}

// Restore all search parameters
function RestoreSearchParms() {
	global $sSrchWhere, $ratings;
	$sSrchWhere = $ratings->getSearchWhere();
}

// Set up Sort parameters based on Sort Links clicked
function SetUpSortOrder() {
	global $ratings;

	// Check for an Order parameter
	if (@$_GET["order"] <> "") {
		$ratings->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
		$ratings->CurrentOrderType = @$_GET["ordertype"];

		// Field id
		$ratings->UpdateSort($ratings->id);

		// Field rating
		$ratings->UpdateSort($ratings->rating);

		// Field domain
		$ratings->UpdateSort($ratings->domain);

		// Field id_2
		$ratings->UpdateSort($ratings->id_2);
		$ratings->setStartRecordNumber(1); // Reset start position
	}
	$sOrderBy = $ratings->getSessionOrderBy(); // Get order by from Session
	if ($sOrderBy == "") {
		if ($ratings->SqlOrderBy() <> "") {
			$sOrderBy = $ratings->SqlOrderBy();
			$ratings->setSessionOrderBy($sOrderBy);
		}
	}
}

// Reset command based on querystring parameter cmd=
// - RESET: reset search parameters
// - RESETALL: reset search & master/detail parameters
// - RESETSORT: reset sort parameters
function ResetCmd() {
	global $sDbMasterFilter, $sDbDetailFilter, $nStartRec, $sOrderBy;
	global $ratings;

	// Get reset cmd
	if (@$_GET["cmd"] <> "") {
		$sCmd = $_GET["cmd"];

		// Reset search criteria
		if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall") {
			ResetSearchParms();
		}

		// Reset Sort Criteria
		if (strtolower($sCmd) == "resetsort") {
			$sOrderBy = "";
			$ratings->setSessionOrderBy($sOrderBy);
			$ratings->id->setSort("");
			$ratings->rating->setSort("");
			$ratings->domain->setSort("");
			$ratings->id_2->setSort("");
		}

		// Reset start position
		$nStartRec = 1;
		$ratings->setStartRecordNumber($nStartRec);
	}
}
?>
<?php

// Set up Starting Record parameters based on Pager Navigation
function SetUpStartRec() {
	global $nDisplayRecs, $nStartRec, $nTotalRecs, $nPageNo, $ratings;
	if ($nDisplayRecs == 0) return;

	// Check for a START parameter
	if (@$_GET[EW_TABLE_START_REC] <> "") {
		$nStartRec = $_GET[EW_TABLE_START_REC];
		$ratings->setStartRecordNumber($nStartRec);
	} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
		$nPageNo = $_GET[EW_TABLE_PAGE_NO];
		if (is_numeric($nPageNo)) {
			$nStartRec = ($nPageNo-1)*$nDisplayRecs+1;
			if ($nStartRec <= 0) {
				$nStartRec = 1;
			} elseif ($nStartRec >= intval(($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1) {
				$nStartRec = intval(($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1;
			}
			$ratings->setStartRecordNumber($nStartRec);
		} else {
			$nStartRec = $ratings->getStartRecordNumber();
		}
	} else {
		$nStartRec = $ratings->getStartRecordNumber();
	}

	// Check if correct start record counter
	if (!is_numeric($nStartRec) || $nStartRec == "") { // Avoid invalid start record counter
		$nStartRec = 1; // Reset start record counter
		$ratings->setStartRecordNumber($nStartRec);
	} elseif (intval($nStartRec) > intval($nTotalRecs)) { // Avoid starting record > total records
		$nStartRec = intval(($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1; // Point to last page first record
		$ratings->setStartRecordNumber($nStartRec);
	} elseif (($nStartRec-1) % $nDisplayRecs <> 0) {
		$nStartRec = intval(($nStartRec-1)/$nDisplayRecs)*$nDisplayRecs+1; // Point to page boundary
		$ratings->setStartRecordNumber($nStartRec);
	}
}
?>
<?php

// Load recordset
function LoadRecordset($offset = -1, $rowcnt = -1) {
	global $conn, $ratings;

	// Call Recordset Selecting event
	$ratings->Recordset_Selecting($ratings->CurrentFilter);

	// Load list page sql
	$sSql = $ratings->SelectSQL();
	if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

	// Load recordset
	$conn->raiseErrorFn = 'ew_ErrorFn';	
	$rs = $conn->Execute($sSql);
	$conn->raiseErrorFn = '';

	// Call Recordset Selected event
	$ratings->Recordset_Selected($rs);
	return $rs;
}
?>
<?php

// Load row based on key values
function LoadRow() {
	global $conn, $Security, $ratings;
	$sFilter = $ratings->SqlKeyFilter();
	if (!is_numeric($ratings->id_2->CurrentValue)) {
		return FALSE; // Invalid key, exit
	}
	$sFilter = str_replace("@id_2@", ew_AdjustSql($ratings->id_2->CurrentValue), $sFilter); // Replace key value

	// Call Row Selecting event
	$ratings->Row_Selecting($sFilter);

	// Load sql based on filter
	$ratings->CurrentFilter = $sFilter;
	$sSql = $ratings->SQL();
	if ($rs = $conn->Execute($sSql)) {
		if ($rs->EOF) {
			$LoadRow = FALSE;
		} else {
			$LoadRow = TRUE;
			$rs->MoveFirst();
			LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$ratings->Row_Selected($rs);
		}
		$rs->Close();
	} else {
		$LoadRow = FALSE;
	}
	return $LoadRow;
}

// Load row values from recordset
function LoadRowValues(&$rs) {
	global $ratings;
	$ratings->id->setDbValue($rs->fields('id'));
	$ratings->rating->setDbValue($rs->fields('rating'));
	$ratings->domain->setDbValue($rs->fields('domain'));
	$ratings->id_2->setDbValue($rs->fields('id_2'));
}
?>
<?php

// Render row values based on field settings
function RenderRow() {
	global $conn, $Security, $ratings;

	// Call Row Rendering event
	$ratings->Row_Rendering();

	// Common render codes for all row types
	// id

	$ratings->id->CellCssStyle = "";
	$ratings->id->CellCssClass = "";

	// rating
	$ratings->rating->CellCssStyle = "";
	$ratings->rating->CellCssClass = "";

	// domain
	$ratings->domain->CellCssStyle = "";
	$ratings->domain->CellCssClass = "";

	// id_2
	$ratings->id_2->CellCssStyle = "";
	$ratings->id_2->CellCssClass = "";
	if ($ratings->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$ratings->id->ViewValue = $ratings->id->CurrentValue;
		$ratings->id->CssStyle = "";
		$ratings->id->CssClass = "";
		$ratings->id->ViewCustomAttributes = "";

		// rating
		$ratings->rating->ViewValue = $ratings->rating->CurrentValue;
		$ratings->rating->CssStyle = "";
		$ratings->rating->CssClass = "";
		$ratings->rating->ViewCustomAttributes = "";

		// domain
		$ratings->domain->ViewValue = $ratings->domain->CurrentValue;
		if (!is_null($ratings->domain->ViewValue)) $ratings->domain->ViewValue = str_replace("\n", "<br>", $ratings->domain->ViewValue); 
		$ratings->domain->CssStyle = "";
		$ratings->domain->CssClass = "";
		$ratings->domain->ViewCustomAttributes = "";

		// id_2
		$ratings->id_2->ViewValue = $ratings->id_2->CurrentValue;
		$ratings->id_2->CssStyle = "";
		$ratings->id_2->CssClass = "";
		$ratings->id_2->ViewCustomAttributes = "";

		// id
		$ratings->id->HrefValue = "";

		// rating
		$ratings->rating->HrefValue = "";

		// domain
		$ratings->domain->HrefValue = "";

		// id_2
		$ratings->id_2->HrefValue = "";
	} elseif ($ratings->RowType == EW_ROWTYPE_ADD) { // Add row
	} elseif ($ratings->RowType == EW_ROWTYPE_EDIT) { // Edit row
	} elseif ($ratings->RowType == EW_ROWTYPE_SEARCH) { // Search row
	}

	// Call Row Rendered event
	$ratings->Row_Rendered();
}
?>
<?php

// Export data in Xml or Csv format
function ExportData() {
	global $nTotalRecs, $nStartRec, $nStopRec, $nTotalRecs, $nDisplayRecs, $ratings;
	$sCsvStr = "";
	$rs = LoadRecordset();
	$nTotalRecs = $rs->RecordCount();
	$nStartRec = 1;

	// Export all
	if (defined("EW_EXPORT_ALL")) {
		$nStopRec = $nTotalRecs;
	} else { // Export 1 page only
		SetUpStartRec(); // Set Up Start Record Position

		// Set the last record to display
		if ($nDisplayRecs < 0) {
			$nStopRec = $nTotalRecs;
		} else {
			$nStopRec = $nStartRec + $nDisplayRecs - 1;
		}
	}
	if ($ratings->Export == "csv") {
		$sCsvStr .= "id" . ",";
		$sCsvStr .= "rating" . ",";
		$sCsvStr .= "domain" . ",";
		$sCsvStr .= "id_2" . ",";
		$sCsvStr = substr($sCsvStr, 0, strlen($sCsvStr)-1); // Remove last comma
		$sCsvStr .= "\n";
	}

	// Move to first record directly for performance reason
	$nRecCount = $nStartRec - 1;
	if (!$rs->EOF) {
		$rs->MoveFirst();
		$rs->Move($nStartRec - 1);
	}
	while (!$rs->EOF && $nRecCount < $nStopRec) {
		$nRecCount++;
		if (intval($nRecCount) >= intval($nStartRec)) {
			LoadRowValues($rs);
			if ($ratings->Export == "csv") {
				$sCsvStr .= '"' . str_replace('"', '""', strval($ratings->id->CurrentValue)) . '",';
				$sCsvStr .= '"' . str_replace('"', '""', strval($ratings->rating->CurrentValue)) . '",';
				$sCsvStr .= '"' . str_replace('"', '""', strval($ratings->domain->CurrentValue)) . '",';
				$sCsvStr .= '"' . str_replace('"', '""', strval($ratings->id_2->CurrentValue)) . '",';
				$sCsvStr = substr($sCsvStr, 0, strlen($sCsvStr)-1); // Remove last comma
				$sCsvStr .= "\n";
			}
		}
		$rs->MoveNext();
	}

	// Close recordset
	$rs->Close();
	if ($ratings->Export == "csv") {
		echo $sCsvStr;
	}
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