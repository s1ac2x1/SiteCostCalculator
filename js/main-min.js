function firstCheck(d_, id_) {

var a;
var b=document.getElementById("url").value;
b=b.replace(/ /g,"");
b=b.replace("http://www.","");
b=b.replace("http://","");
if(b.indexOf("www.")==0){b=b.replace("www.","")}


		document.getElementById('res').innerHTML = "<center><img src='a.gif'></center>";

		new Ajax.Request('scancheck.php?domain=' + b, {
		  onSuccess: function(response) {
		        var html = response.responseText;
			String.prototype.trim=function(){return this.replace(/^\s\s*/, '').replace(/\s\s*$/, '');};
			html = html.trim();
			if (html == "yes") {
			       document.getElementById('res').innerHTML = "<center><h2>" + saleUpd4 + "</h2></center>";
				ScrollToElement(document.getElementById("res"));
			} else {
				getAll(d_, id_);
			}

		  }
		});
}

function go(a){window.location.href=a}function updateNew(a){document.getElementById("updateTw").innerHTML="<img src='a.gif' style='margin-bottom:-7px;'> "+f4;new Ajax.Request("web.php?url="+a,{onSuccess:function(b){document.getElementById("updateTw").innerHTML="<img src='a.gif' style='margin-bottom:-7px;'> "+add1;new Ajax.Request("seo/prUpdate.php?domain="+a,{onSuccess:function(b){document.getElementById("updateTw").innerHTML="<img src='a.gif' style='margin-bottom:-7px;'> "+add2;new Ajax.Request("seo/saveGoogleBacks.php?domain="+a,{onSuccess:function(b){document.getElementById("updateTw").innerHTML="<img src='a.gif' style='margin-bottom:-7px;'> "+add2_;new Ajax.Request("seo/saveYahooBacks.php?domain="+a,{onSuccess:function(b){document.getElementById("updateTw").innerHTML="<img src='a.gif' style='margin-bottom:-7px;'> "+add4;new Ajax.Request("seo/r.php?domain="+a,{onSuccess:function(b){document.getElementById("updateTw").innerHTML="<img src='a.gif' style='margin-bottom:-7px;'> 4..";new Ajax.Request("seo/updateTitle.php?domain="+a,{onSuccess:function(b){document.getElementById("updateTw").innerHTML="<img src='a.gif' style='margin-bottom:-7px;'> 3..";new Ajax.Request("seo/updateDescription.php?domain="+a,{onSuccess:function(b){document.getElementById("updateTw").innerHTML="<img src='a.gif' style='margin-bottom:-7px;'> 2..";new Ajax.Request("seo/updateKeys.php?domain="+a,{onSuccess:function(b){document.getElementById("updateTw").innerHTML="<img src='a.gif' style='margin-bottom:-7px;'> 1..";new Ajax.Request("seo/sale.php?domain="+a,{onSuccess:function(b){var c=b.responseText;if(c=="good"){new Ajax.Request("saleInfo.php?domain="+a+"&lang="+lang,{onSuccess:function(b){var c=b.responseText;document.getElementById("updateNew").innerHTML="";document.getElementById("updateTw").innerHTML=saleUpd1+": <a href='http://' + mainTitle + '/www."+a+"'>http://"+mainTitle+"/www."+a+"</a><br><br><font style='background-color:rgb(175, 238, 166);'>"+saleGood+"</font><br><br>"+c+"<br><br><br>"}})}if(c=="bad"){document.getElementById("updateNew").innerHTML="";document.getElementById("updateTw").innerHTML=saleUpd2}

if(c=="disabled"){document.getElementById("updateNew").innerHTML="";document.getElementById("updateTw").innerHTML=saleUpd4}
}})}})}})}})}})}})}})}})}})}function getAll(days, domainId){
var a;
var b=document.getElementById("url").value;
b=b.replace(/ /g,"");
b=b.replace("http://www.","");
b=b.replace("http://","");
if(b.indexOf("www.")==0){b=b.replace("www.","")}




if (days > 21) {
	var out = "<center><font style='font-family: georgia, serif; font-size:12pt;'>" + needUpdate1 + " ( " + days + " " + numEnd(days, cDay1, cDay2, cDay5) + " " + cAgo + ")<br>" + needUpdate2 + "</font></center><br>";
	document.getElementById('temp').innerHTML = out;
updateAll(domainId);
return;
}
document.getElementById("logo").innerHTML="<center><b>"+f4+"</b><br><img src='a.gif'></center>";

new Ajax.Request("getInfo.php?domain="+b+"&what=all"+"&lang="+lang,{
	onSuccess:function(c){
		var d=c.responseText;a=d;d=d.replace(/^\s+|\s+$/g,"");
		if(d.length<3) {
			document.getElementById("logo").innerHTML="<center><b>"+f4_+"</b><br><img src='a.gif'></center>";
			new Ajax.Request("web.php?url="+b,{
				onSuccess:function(a){
					document.getElementById("logo").innerHTML="<center><b>"+add1+"</b><br><img src='a.gif'></center>";
					new Ajax.Request("seo/prUpdate.php?domain="+b,{
						onSuccess:function(a){
							document.getElementById("logo").innerHTML="<center><b>"+add2+"</b><br><img src='a.gif'></center>";
							new Ajax.Request("seo/saveGoogleBacks.php?domain="+b,{
								onSuccess:function(a){
									document.getElementById("logo").innerHTML="<center><b>"+add2_+"</b><br><img src='a.gif'></center>";
									new Ajax.Request("seo/saveYahooBacks.php?domain="+b,{
										onSuccess:function(a){
											document.getElementById("logo").innerHTML="<center><b>"+add4+"</b><br><img src='a.gif'></center>";
											new Ajax.Request("seo/r.php?domain="+b,{
												onSuccess:function(a){
													document.getElementById("logo").innerHTML="<center><b>1/3</b><br><img src='a.gif'></center>";
													new Ajax.Request("seo/updateTitle.php?domain="+b,{
														onSuccess:function(a){
															document.getElementById("logo").innerHTML="<center><b>2/3</b><br><img src='a.gif'></center>";
															new Ajax.Request("seo/updateDescription.php?domain="+b,{
																onSuccess:function(a){
																	document.getElementById("logo").innerHTML="<center><b>3/3</b><br><img src='a.gif'></center>";
																	new Ajax.Request("seo/updateKeys.php?domain="+b,{
																		onSuccess:function(a){
																			new Ajax.Request("seo/sale.php?domain="+b,{
																				onSuccess:function(a){
																				new Ajax.Request("seo/worth.php?domain="+b,{
																					onSuccess:function(a){
																				new Ajax.Request("getInfo.php?domain="+b+"&what=all"+"&lang="+lang,{
																					onSuccess:function(a){
																					var c=a.responseText;if(c.length<3) {
																						document.getElementById("res").innerHTML="Nope"
																					}
																					document.getElementById("logo").innerHTML=logo;
																					document.getElementById("res").innerHTML=c;
																					ScrollToElement(document.getElementById("gohere"));
																					new Ajax.Request("sortAllPag.php?domain="+b+"&lang="+lang,{
																						onSuccess:function(a){
																							var b=a.responseText;
																							document.getElementById("sortable").innerHTML=b
																						}
																					})
																		        }
																		  })
																		        }
																		  })
																		  
																		  
}})}})}})}})}})}})}})}})}})}else{
document.getElementById("logo").innerHTML=logo;
document.getElementById("res").innerHTML=a;
ScrollToElement(document.getElementById("gohere"));
new Ajax.Request("getCountry.php?domain="+b,{
	onSuccess:function(a){
		var c=a.responseText;
		new Ajax.Request("sortAllPag.php?domain="+b+"&lang="+lang,{
			onSuccess:function(a){
				var b=a.responseText;
				document.getElementById("sortable").innerHTML=b}})}})}}})}

function lastCalculated(a){document.getElementById("lastTitle").innerHTML="<img src='a.gif' align='center'>";new Ajax.Request("lastCalculated.php?page="+a+"&lang="+lang,{onSuccess:function(a){var b=a.responseText;document.getElementById("lastCalculated").innerHTML=b}})}function sortAllPag(a,b,c){document.getElementById("stitle").innerHTML="<img src='a.gif' align='center'>";new Ajax.Request("sortAllPag.php?domain="+a+"&page="+c+"&country="+b+"&lang="+lang,{onSuccess:function(a){var b=a.responseText;document.getElementById("sortable").innerHTML=b}})}function loadKeys(a,b,c,d){document.getElementById("customKey").value=a;document.getElementById("semantic").innerHTML="<center><br><br><img src='a.gif'></center>";var e="";if(d){e="key="+a+"&findType="+b+"&sortBy="+c+"&lang="+lang+"&page="+d}else{e="key="+a+"&findType="+b+"&sortBy="+c+"&lang="+lang}new Ajax.Request("seo/semantic.php",{method:"GET",parameters:e,onSuccess:function(a){var b=a.responseText;document.getElementById("semantic").innerHTML=b}})}function updateLinks(a){document.getElementById("googleIndexedPages").innerHTML="<center><img src='a.gif'></center>";new Ajax.Request("seo/r.php?domain="+a+"&custom=true&what=googleIndexedPages",{onSuccess:function(b){var c=b.responseText;document.getElementById("googleIndexedPages").innerHTML=c;document.getElementById("bingLinks").innerHTML="<center><img src='a.gif'></center>";new Ajax.Request("seo/r.php?domain="+a+"&custom=true&what=bingLinks",{onSuccess:function(b){var c=b.responseText;document.getElementById("bingLinks").innerHTML=c;document.getElementById("alexaLinks").innerHTML="<center><img src='a.gif'></center>";new Ajax.Request("seo/r.php?domain="+a+"&custom=true&what=alexaLinks",{onSuccess:function(b){var c=b.responseText;document.getElementById("alexaLinks").innerHTML=c;document.getElementById("bingIndexedPages").innerHTML="<center><img src='a.gif'></center>";new Ajax.Request("seo/r.php?domain="+a+"&custom=true&what=bingIndexedPages",{onSuccess:function(b){var c=b.responseText;document.getElementById("bingIndexedPages").innerHTML=c;document.getElementById("dmozCat").innerHTML="<center><img src='a.gif'></center>";new Ajax.Request("seo/r.php?domain="+a+"&custom=true&what=dmozCat",{onSuccess:function(b){var c=b.responseText;document.getElementById("dmozCat").innerHTML=c;document.getElementById("advisorRel").innerHTML="<center><img src='a.gif'></center>";new Ajax.Request("seo/r.php?domain="+a+"&custom=true&what=advisorRel",{onSuccess:function(b){var c=b.responseText;document.getElementById("advisorRel").innerHTML="<img src='"+c+"'>";document.getElementById("WOTRating").innerHTML="<center><img src='a.gif'></center>";new Ajax.Request("seo/r.php?domain="+a+"&custom=true&what=WOTRating",{onSuccess:function(a){var b=a.responseText;document.getElementById("WOTRating").innerHTML=b}})}})}})}})}})}})}})}function updateKeys(a){document.getElementById("w_keys").innerHTML="<img src='a.gif'>";new Ajax.Request("seo/updateKeys.php?domain="+a,{onSuccess:function(a){var b=a.responseText;document.getElementById("w_keys").innerHTML=b}})}function updateDescription(a){document.getElementById("w_desc").innerHTML="<img src='a.gif'>";new Ajax.Request("seo/updateDescription.php?domain="+a,{onSuccess:function(a){var b=a.responseText;document.getElementById("w_desc").innerHTML=b}})}function updateTitle(a){document.getElementById("w_title").innerHTML="<img src='a.gif'>";new Ajax.Request("seo/updateTitle.php?domain="+a,{onSuccess:function(a){var b=a.responseText;document.getElementById("w_title").innerHTML=b}})}function clearFields(){document.getElementById("en").checked=false;document.getElementById("ru").checked=false;document.getElementById("siteTitle").value="";document.getElementById("siteDesc").value="";document.getElementById("siteKeys").value="";document.getElementById("siteAge").value="";document.getElementById("sitePr").value="";document.getElementById("siteCostFrom").value="";document.getElementById("siteCostTo").value="";document.getElementById("siteInFrom").value="";document.getElementById("siteInTo").value="";document.getElementById("siteOutFrom").value="";document.getElementById("siteOutTo").value="";document.getElementById("siteIncomeTypes").value="";document.getElementById("siteAlexa").value=""}function search(a,b){var c=document.getElementById("en").checked;var d=document.getElementById("ru").checked;var e="";if(c){e="en"}if(d){e="ru"}if(!c&&!d){e="all"}if(c&&d){e="all"}var f=document.getElementById("siteTitle").value;f=f.replace(/"/g,"").replace(/'/g,"");var g=document.getElementById("siteDesc").value;g=g.replace(/"/g,"").replace(/'/g,"");var h=document.getElementById("siteKeys").value;h=h.replace(/"/g,"").replace(/'/g,"");var i=document.getElementById("siteAge").value;i=i.replace(/"/g,"").replace(/'/g,"");var j=document.getElementById("sitePr").value;j=j.replace(/"/g,"").replace(/'/g,"");var k=document.getElementById("siteCostFrom").value;k=k.replace(/"/g,"").replace(/'/g,"");var l=document.getElementById("siteCostTo").value;l=l.replace(/"/g,"").replace(/'/g,"");var m=document.getElementById("siteInFrom").value;m=m.replace(/"/g,"").replace(/'/g,"");var n=document.getElementById("siteInTo").value;n=n.replace(/"/g,"").replace(/'/g,"");var o=document.getElementById("siteOutFrom").value;o=o.replace(/"/g,"").replace(/'/g,"");var p=document.getElementById("siteOutTo").value;p=p.replace(/"/g,"").replace(/'/g,"");var q=document.getElementById("siteIncomeTypes").value;q=q.replace(/"/g,"").replace(/'/g,"");var r=document.getElementById("siteAlexa").value;r=r.replace(/"/g,"").replace(/'/g,"");document.getElementById("searchRes").innerHTML="<center><br><br><img src='a.gif'></center>";var s="lang="+e+"&siteTitle="+f+"&siteDesc="+g+"&siteKeys="+h+"&siteAge="+i+"&sitePr="+j+"&siteCostFrom="+k+"&siteCostTo="+l+"&siteInFrom="+m+"&siteInTo="+n+"&siteOutFrom="+o+"&siteOutTo="+p+"&siteIncomeTypes="+q+"&siteAlexa="+r+"&language="+lang+"&page="+a+"&type="+b;new Ajax.Request("seo/search.php",{method:"GET",parameters:s,onSuccess:function(a){var b=a.responseText;document.getElementById("searchRes").innerHTML=b}})}function loadAlexa(a,b,c){document.getElementById("alexa").innerHTML="<center><br><br><img src='a.gif'></center>";new Ajax.Request("seo/alexa.php?domain="+a+"&type="+b+"&time="+c,{onSuccess:function(a){var b=a.responseText;document.getElementById("alexa").innerHTML=b}})}function saleSearch(){document.getElementById("res").innerHTML="<center><b>"+processing+"</b><br><img src='a.gif'><br><br></center></a>";new Ajax.Request("saleSearch.php?lang="+lang,{onSuccess:function(a){var b=a.responseText;document.getElementById("res").innerHTML=b;ScrollToElement(document.getElementById("gohere"))}})}function loadSale(){document.getElementById("res").innerHTML="<center><b>"+processing+"</b><br><img src='a.gif'><br><br></center></a>";new Ajax.Request("forsale.php?lang="+lang,{onSuccess:function(a){var b=a.responseText;document.getElementById("res").innerHTML=b;ScrollToElement(document.getElementById("gohere"))}})}function loadUseful(a){document.getElementById("useful").innerHTML="<center><br><br><img src='a.gif'></center>";new Ajax.Request("useful.php?qq="+a,{onSuccess:function(b){var c=b.responseText;document.getElementById("useful").style.background="url("+a+".jpg)";document.getElementById("useful").innerHTML=c}})}

function updateAll(a){document.getElementById("logo").innerHTML="<center><b>"+f3+"</b><br><img src='a.gif'></center>";document.getElementById("res").innerHTML="";new Ajax.Request("getDomain.php?id="+a,{onSuccess:function(b){var c=b.responseText;new Ajax.Request("main_lib_update.php",{method:"POST",parameters:"updateok=updateok&domain="+c+"&id="+a,onSuccess:function(a){document.getElementById("logo").innerHTML="<center><b>"+f3_+"</b><br><img src='a.gif'></center>";new Ajax.Request("seo/prUpdate.php?domain="+c,{onSuccess:function(a){document.getElementById("logo").innerHTML="<center><b>"+add3+"</b><br><img src='a.gif'></center>";new Ajax.Request("seo/saveGoogleBacks.php?domain="+c,{onSuccess:function(a){var b=a.responseText;document.getElementById("logo").innerHTML="<center><b>"+add4+"</b><br><img src='a.gif'></center>";new Ajax.Request("seo/r.php?domain="+c,{onSuccess:function(a){document.getElementById("logo").innerHTML="<center><b>"+add2_+"</b><br><img src='a.gif'></center>";new Ajax.Request("seo/saveYahooBacks.php?domain="+c,{onSuccess:function(a){document.getElementById("logo").innerHTML="<center><b>3/3</b><br><img src='a.gif'></center>";new Ajax.Request("seo/updateTitle.php?domain="+c,{onSuccess:function(a){document.getElementById("logo").innerHTML="<center><b>2/3</b><br><img src='a.gif'></center>";new Ajax.Request("seo/updateDescription.php?domain="+c,{onSuccess:function(a){document.getElementById("logo").innerHTML="<center><b>1/3</b><br><img src='a.gif'></center>";new Ajax.Request("seo/updateKeys.php?domain="+c,{onSuccess:function(a){new Ajax.Request("seo/sale.php?domain="+c,{onSuccess:function(a){
new Ajax.Request("seo/worth.php?domain="+c, {
	onSuccess:function(a) {
		new Ajax.Request("getInfo.php?domain="+c+"&what=all"+"&lang="+lang, {
			onSuccess:function(a) {
				var b=a.responseText;document.getElementById("logo").innerHTML=logo;document.getElementById("res").innerHTML=b;
				document.getElementById("temp").innerHTML = "";
				ScrollToElement(document.getElementById("gohere"))
		        }}
		    )
        }}
    )
}})}})}})}})}})}})}})}})}})}})
}

function updateTags(){var a=document.getElementById("updateT").value;document.getElementById("updateTw").innerHTML="<img src='a.gif' style='margin-bottom:-7px;'>";new Ajax.Request("getIdByDomain.php?domain="+a,{onSuccess:function(b){var c=b.responseText;if(c=="bad-1"){document.getElementById("updateTw").innerHTML=saleUpd3;return}else{if(c=="bad-2"){updateNew(a)}else{new Ajax.Request("seo/sale.php?domain="+a,{onSuccess:function(b){var c=b.responseText;if(c=="good"){new Ajax.Request("saleInfo.php?domain="+a+"&lang="+lang,{onSuccess:function(b){var c=b.responseText;document.getElementById("updateTw").innerHTML=saleUpd1+": <a href='http://"+mainTitle+"/www."+a+"'>http://"+mainTitle+"/www."+a+"</a><br><br><font style='background-color:rgb(175, 238, 166);'>"+saleGood+"</font><br><br>"+c+"<br><br>"+unsale}})}if(c=="bad"){document.getElementById("updateTw").innerHTML=saleUpd2}if(c=="disabled"){document.getElementById("updateTw").innerHTML=saleUpd4}}})}}}})}function getDomain(a){return a.match(/:\/\/(.[^/]+)/)[1]}function getAll2(){var a=document.getElementById("url").value;a=a.replace(/ /g,"");a=a.replace("http://www.","");a=a.replace("http://","");if(a.indexOf("www.")==0){a=a.replace("www.","")}window.location.href="http://"+mainTitle+"/index.php?d="+a}function ScrollToElement(a){var b=0;var c=0;while(a!=null){b+=a.offsetLeft;c+=a.offsetTop;a=a.offsetParent}window.scrollTo(b,c)}