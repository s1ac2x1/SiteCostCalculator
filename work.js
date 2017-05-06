function loadS(domain) {
    document.getElementById('url').value = domain;
    //sortAllPag(domain, '', '');
    getAll(domain);
}
function updateAll(id) {
    document.getElementById('res').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/getDomain.php?id=' + id, {
        onSuccess: function (response) {
            var domain = response.responseText;
            new Ajax.Request('http://sitecostcalculator.com/main_lib_update.php', {
                method: 'POST',
                parameters: 'updateok=updateok&domain=' + domain + '&id=' + id,
                onSuccess: function (response) {
                    new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=all', {
                        onSuccess: function (response) {
                            var html2 = response.responseText;
                            document.getElementById('res').innerHTML = html2;
                        }
                    });
                }
            });
        }
    });
}
function getWorth() {
    var worth;
    var domain = document.getElementById('url').value;
    domain = domain.replace(/ /g, '');
    document.getElementById('res').innerHTML = "<img src='loader.gif' align='center'>";
    document.getElementById('stitle').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=worth', {
        onSuccess: function (response) {
            var html = response.responseText;
            worth = html;
            html = html.replace(/ /g, '');
            if (!html) {
                new Ajax.Request('http://sitecostcalculator.com/web.php?url=' + domain, {
                    onSuccess: function (response) {
                        new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=worth', {
                            onSuccess: function (response) {
                                var html2 = response.responseText;
                                document.getElementById('res').innerHTML = html2;
                                new Ajax.Request('http://sitecostcalculator.com/getCountry.php?domain=' + domain, {
                                    onSuccess: function (response) {
                                        var c = response.responseText;
                                        new Ajax.Request('http://sitecostcalculator.com/sortWorthPag.php?country=' + c, {
                                            onSuccess: function (response) {
                                                var html3 = response.responseText;
                                                document.getElementById('sortable').innerHTML = html3;
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    }
                });
            } else {
                document.getElementById('res').innerHTML = worth;
                new Ajax.Request('http://sitecostcalculator.com/getCountry.php?domain=' + domain, {
                    onSuccess: function (response) {
                        var c = response.responseText;
                        new Ajax.Request('http://sitecostcalculator.com/sortWorthPag.php?country=' + c, {
                            onSuccess: function (response) {
                                var html3 = response.responseText;
                                document.getElementById('sortable').innerHTML = html3;
                            }
                        });
                    }
                });
            }
        }
    });
}
function similarPr(id) {
    document.getElementById('stitle').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/similarPr.php?id=' + id, {
        onSuccess: function (response) {
            var html3 = response.responseText;
            document.getElementById('sortable').innerHTML = html3;
        }
    });
}
function total() {
    new Ajax.Request('http://sitecostcalculator.com/total.php', {
        onSuccess: function (response) {
            var html3 = response.responseText;
            document.getElementById('total').innerHTML = html3;
        }
    });
}
function footer() {
    new Ajax.Request('http://sitecostcalculator.com/footer.php', {
        onSuccess: function (response) {
            var html3 = response.responseText;
            document.getElementById('footer').innerHTML = html3;
        }
    });
}
function similarPrPag(country, pr, page) {
    document.getElementById('stitle').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/similarPrPag.php?country=' + country + '&pr=' + pr + '&page=' + page, {
        onSuccess: function (response) {
            var html3 = response.responseText;
            document.getElementById('sortable').innerHTML = html3;
        }
    });
}
function sortYearsPag(years, country, page) {
    document.getElementById('stitle').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/sortYearsPag.php?years=' + years + '&country=' + country + '&page=' + page, {
        onSuccess: function (response) {
            var html3 = response.responseText;
            document.getElementById('sortable').innerHTML = html3;
        }
    });
}
function sortWorthPag(country, page) {
    document.getElementById('stitle').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/sortWorthPag.php?country=' + country + '&page=' + page, {
        onSuccess: function (response) {
            var html3 = response.responseText;
            document.getElementById('sortable').innerHTML = html3;
        }
    });
}
function sortDpviewPag(country, page) {
    document.getElementById('stitle').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/sortDpviewPag.php?country=' + country + '&page=' + page, {
        onSuccess: function (response) {
            var html3 = response.responseText;
            document.getElementById('sortable').innerHTML = html3;
        }
    });
}
function sortBacksPag(country, page) {
    document.getElementById('stitle').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/sortBacksPag.php?country=' + country + '&page=' + page, {
        onSuccess: function (response) {
            var html3 = response.responseText;
            document.getElementById('sortable').innerHTML = html3;
        }
    });
}
function sortDearnPag(country, page) {
    document.getElementById('stitle').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/sortDearnPag.php?country=' + country + '&page=' + page, {
        onSuccess: function (response) {
            var html3 = response.responseText;
            document.getElementById('sortable').innerHTML = html3;
        }
    });
}
function similarPrAll(id) {
    document.getElementById('stitle').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/similarPrAll.php?id=' + id, {
        onSuccess: function (response) {
            var html3 = response.responseText;
            document.getElementById('sortable').innerHTML = html3;
        }
    });
}
function sortYears(id) {
    document.getElementById('stitle').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/sortYears.php?id=' + id, {
        onSuccess: function (response) {
            var html3 = response.responseText;
            document.getElementById('sortable').innerHTML = html3;
        }
    });
}
function sortYearsAll(id) {
    document.getElementById('stitle').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/sortYearsAll.php?id=' + id, {
        onSuccess: function (response) {
            var html3 = response.responseText;
            document.getElementById('sortable').innerHTML = html3;
        }
    });
}
function similarDomainNames(domain) {
    document.getElementById('stitle').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/similarDomainNames.php?domain=' + domain, {
        onSuccess: function (response) {
            var html3 = response.responseText;
            document.getElementById('sortable').innerHTML = html3;
        }
    });
}
function sortAllPag(domain, country, page) {
    document.getElementById('stitle').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/sortAllPag.php?domain=' + domain + '&page=' + page + '&country=' + country, {
        onSuccess: function (response) {
            var html3 = response.responseText;
            document.getElementById('sortable').innerHTML = html3;
        }
    });
}
function lastCalculated(page) {
    document.getElementById('lastTitle').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/lastCalculated.php?page=' + page, {
        onSuccess: function (response) {
            var html3 = response.responseText;
            document.getElementById('lastCalculated').innerHTML = html3;
        }
    });
}
function topWorld(page) {
    document.getElementById('stitle').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/topWorld.php?page=' + page, {
        onSuccess: function (response) {
            var html3 = response.responseText;
            document.getElementById('sortable').innerHTML = html3;
        }
    });
}
function getVisits() {
    var dpview;
    var domain = document.getElementById('url').value;
    document.getElementById('res').innerHTML = "<img src='loader.gif' align='center'>";
    document.getElementById('stitle').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=dpview', {
        onSuccess: function (response) {
            var html = response.responseText;
            dpview = html;
            html = html.replace(/ /g, '');
            if (!html) {
                new Ajax.Request('http://sitecostcalculator.com/web.php?url=' + domain, {
                    onSuccess: function (response) {
                        new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=dpview', {
                            onSuccess: function (response) {
                                var html2 = response.responseText;
                                document.getElementById('res').innerHTML = html2;
                                new Ajax.Request('http://sitecostcalculator.com/getCountry.php?domain=' + domain, {
                                    onSuccess: function (response) {
                                        var c = response.responseText;
                                        new Ajax.Request('http://sitecostcalculator.com/sortDpviewPag.php?country=' + c, {
                                            onSuccess: function (response) {
                                                var html3 = response.responseText;
                                                document.getElementById('sortable').innerHTML = html3;
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    }
                });
            } else {
                document.getElementById('res').innerHTML = dpview;
                new Ajax.Request('http://sitecostcalculator.com/getCountry.php?domain=' + domain, {
                    onSuccess: function (response) {
                        var c = response.responseText;
                        new Ajax.Request('http://sitecostcalculator.com/sortDpviewPag.php?country=' + c, {
                            onSuccess: function (response) {
                                var html3 = response.responseText;
                                document.getElementById('sortable').innerHTML = html3;
                            }
                        });
                    }
                });
            }
        }
    });
}
function getEarn() {
    var dearn;
    var domain = document.getElementById('url').value;
    document.getElementById('res').innerHTML = "<img src='loader.gif' align='center'>";
    document.getElementById('stitle').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=dearn', {
        onSuccess: function (response) {
            var html = response.responseText;
            dearn = html;
            html = html.replace(/ /g, '');
            if (!html) {
                new Ajax.Request('http://sitecostcalculator.com/web.php?url=' + domain, {
                    onSuccess: function (response) {
                        new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=dearn', {
                            onSuccess: function (response) {
                                var html2 = response.responseText;
                                document.getElementById('res').innerHTML = html2;
                                new Ajax.Request('http://sitecostcalculator.com/getCountry.php?domain=' + domain, {
                                    onSuccess: function (response) {
                                        var c = response.responseText;
                                        new Ajax.Request('http://sitecostcalculator.com/sortDearnPag.php?country=' + c, {
                                            onSuccess: function (response) {
                                                var html3 = response.responseText;
                                                document.getElementById('sortable').innerHTML = html3;
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    }
                });
            } else {
                document.getElementById('res').innerHTML = dearn;
                new Ajax.Request('http://sitecostcalculator.com/getCountry.php?domain=' + domain, {
                    onSuccess: function (response) {
                        var c = response.responseText;
                        new Ajax.Request('http://sitecostcalculator.com/sortDearnPag.php?country=' + c, {
                            onSuccess: function (response) {
                                var html3 = response.responseText;
                                document.getElementById('sortable').innerHTML = html3;
                            }
                        });
                    }
                });
            }
        }
    });
}
function getBacks() {
    var yahoo_back;
    var domain = document.getElementById('url').value;
    document.getElementById('res').innerHTML = "<img src='loader.gif' align='center'>";
    document.getElementById('stitle').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=yahoo_back', {
        onSuccess: function (response) {
            var html = response.responseText;
            yahoo_back = html;
            html = html.replace(/ /g, '');
            if (!html) {
                new Ajax.Request('http://sitecostcalculator.com/web.php?url=' + domain, {
                    onSuccess: function (response) {
                        new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=yahoo_back', {
                            onSuccess: function (response) {
                                var html2 = response.responseText;
                                document.getElementById('res').innerHTML = html2;
                                new Ajax.Request('http://sitecostcalculator.com/getCountry.php?domain=' + domain, {
                                    onSuccess: function (response) {
                                        var c = response.responseText;
                                        new Ajax.Request('http://sitecostcalculator.com/sortBacksPag.php?country=' + c, {
                                            onSuccess: function (response) {
                                                var html3 = response.responseText;
                                                document.getElementById('sortable').innerHTML = html3;
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    }
                });
            } else {
                document.getElementById('res').innerHTML = yahoo_back;
                new Ajax.Request('http://sitecostcalculator.com/getCountry.php?domain=' + domain, {
                    onSuccess: function (response) {
                        var c = response.responseText;
                        new Ajax.Request('http://sitecostcalculator.com/sortBacksPag.php?country=' + c, {
                            onSuccess: function (response) {
                                var html3 = response.responseText;
                                document.getElementById('sortable').innerHTML = html3;
                            }
                        });
                    }
                });
            }
        }
    });
}
function getPR() {
    var pagerank;
    var domain = document.getElementById('url').value;
    document.getElementById('res').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=pagerank', {
        onSuccess: function (response) {
            var html = response.responseText;
            pagerank = html;
            html = html.replace(/ /g, '');
            if (!html) {
                new Ajax.Request('http://sitecostcalculator.com/web.php?url=' + domain, {
                    onSuccess: function (response) {
                        new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=pagerank', {
                            onSuccess: function (response) {
                                var html2 = response.responseText;
                                document.getElementById('res').innerHTML = html2;
                            }
                        });
                    }
                });
            } else {
                document.getElementById('res').innerHTML = pagerank;
            }
        }
    });
}
function getAlexa() {
    var alexa;
    var domain = document.getElementById('url').value;
    document.getElementById('res').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=alexa', {
        onSuccess: function (response) {
            var html = response.responseText;
            alexa = html;
            html = html.replace(/ /g, '');
            if (!html) {
                new Ajax.Request('http://sitecostcalculator.com/web.php?url=' + domain, {
                    onSuccess: function (response) {
                        new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=alexa', {
                            onSuccess: function (response) {
                                var html2 = response.responseText;
                                document.getElementById('res').innerHTML = html2;
                            }
                        });
                    }
                });
            } else {
                document.getElementById('res').innerHTML = alexa;
            }
        }
    });
}
function getCountry() {
    var country;
    var domain = document.getElementById('url').value;
    document.getElementById('res').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=country', {
        onSuccess: function (response) {
            var html = response.responseText;
            country = html;
            html = html.replace(/ /g, '');
            if (!html) {
                new Ajax.Request('http://sitecostcalculator.com/web.php?url=' + domain, {
                    onSuccess: function (response) {
                        new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=country', {
                            onSuccess: function (response) {
                                var html2 = response.responseText;
                                document.getElementById('res').innerHTML = html2;
                            }
                        });
                    }
                });
            } else {
                document.getElementById('res').innerHTML = country;
            }
        }
    });
}
function getIP() {
    var ip;
    var domain = document.getElementById('url').value;
    document.getElementById('res').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=ip', {
        onSuccess: function (response) {
            var html = response.responseText;
            ip = html;
            html = html.replace(/ /g, '');
            if (!html) {
                new Ajax.Request('http://sitecostcalculator.com/web.php?url=' + domain, {
                    onSuccess: function (response) {
                        new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=ip', {
                            onSuccess: function (response) {
                                var html2 = response.responseText;
                                document.getElementById('res').innerHTML = html2;
                            }
                        });
                    }
                });
            } else {
                document.getElementById('res').innerHTML = ip;
            }
        }
    });
}
function getAge() {
    var ip;
    var domain = document.getElementById('url').value;
    document.getElementById('res').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=age', {
        onSuccess: function (response) {
            var html = response.responseText;
            age = html;
            html = html.replace(/ /g, '');
            if (!html) {
                new Ajax.Request('http://sitecostcalculator.com/web.php?url=' + domain, {
                    onSuccess: function (response) {
                        new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=age', {
                            onSuccess: function (response) {
                                var html2 = response.responseText;
                                document.getElementById('res').innerHTML = html2;
                            }
                        });
                    }
                });
            } else {
                document.getElementById('res').innerHTML = age;
            }
        }
    });
}
function getYahoo() {
    var yahoodir;
    var domain = document.getElementById('url').value;
    document.getElementById('res').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=yahoodir', {
        onSuccess: function (response) {
            var html = response.responseText;
            yahoodir = html;
            html = html.replace(/ /g, '');
            if (!html) {
                new Ajax.Request('http://sitecostcalculator.com/web.php?url=' + domain, {
                    onSuccess: function (response) {
                        new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=yahoodir', {
                            onSuccess: function (response) {
                                var html2 = response.responseText;
                                document.getElementById('res').innerHTML = html2;
                            }
                        });
                    }
                });
            } else {
                document.getElementById('res').innerHTML = yahoodir;
            }
        }
    });
}
function getDmoz() {
    var dmoz;
    var domain = document.getElementById('url').value;
    document.getElementById('res').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=dmoz', {
        onSuccess: function (response) {
            var html = response.responseText;
            dmoz = html;
            html = html.replace(/ /g, '');
            if (!html) {
                new Ajax.Request('http://sitecostcalculator.com/web.php?url=' + domain, {
                    onSuccess: function (response) {
                        new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=dmoz', {
                            onSuccess: function (response) {
                                var html2 = response.responseText;
                                document.getElementById('res').innerHTML = html2;
                            }
                        });
                    }
                });
            } else {
                document.getElementById('res').innerHTML = dmoz;
            }
        }
    });
}
function getGraph() {
    var graph;
    var domain = document.getElementById('url').value;
    document.getElementById('res').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=graph', {
        onSuccess: function (response) {
            var html = response.responseText;
            graph = html;
            html = html.replace(/ /g, '');
            if (!html) {
                new Ajax.Request('http://sitecostcalculator.com/web.php?url=' + domain, {
                    onSuccess: function (response) {
                        new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=graph', {
                            onSuccess: function (response) {
                                var html2 = response.responseText;
                                document.getElementById('res').innerHTML = html2;
                            }
                        });
                    }
                });
            } else {
                document.getElementById('res').innerHTML = graph;
            }
        }
    });
}
function getAll(domain) {
    var all;
    var domain = document.getElementById('url').value;
    document.getElementById('res').innerHTML = "<center><img src='loader.gif' align='center'></center>";
    document.getElementById('stitle').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=all', {
        onSuccess: function (response) {
            var html = response.responseText;
            all = html;
            html = html.replace(/ /g, '');
            if (!html) {
                new Ajax.Request('http://sitecostcalculator.com/web.php?url=' + domain, {
                    onSuccess: function (response) {
                        new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=all', {
                            onSuccess: function (response) {
                                var html2 = response.responseText;
                                document.getElementById('res').innerHTML = html2;
                                new Ajax.Request('http://sitecostcalculator.com/getCountry.php?domain=' + domain, {
                                    onSuccess: function (response) {
                                        var c = response.responseText;
                                        new Ajax.Request('http://sitecostcalculator.com/sortAllPag.php?domain=' + domain, {
                                            onSuccess: function (response) {
                                                var html3 = response.responseText;
                                                document.getElementById('sortable').innerHTML = html3;
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    }
                });
            } else {
                document.getElementById('res').innerHTML = all;
                new Ajax.Request('http://sitecostcalculator.com/getCountry.php?domain=' + domain, {
                    onSuccess: function (response) {
                        var c = response.responseText;
                        new Ajax.Request('http://sitecostcalculator.com/sortAllPag.php?domain=' + domain, {
                            onSuccess: function (response) {
                                var html3 = response.responseText;
                                document.getElementById('sortable').innerHTML = html3;
                            }
                        });
                    }
                });
            }
        }
    });
}
function fromUrl(domain) {
    var all;
    document.getElementById('res').innerHTML = "<img src='loader.gif' align='center'>";
    document.getElementById('stitle').innerHTML = "<img src='loader.gif' align='center'>";
    new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=all', {
        onSuccess: function (response) {
            var html = response.responseText;
            all = html;
            html = html.replace(/ /g, '');
            if (!html) {
                new Ajax.Request('http://sitecostcalculator.com/web.php?url=' + domain, {
                    onSuccess: function (response) {
                        new Ajax.Request('http://sitecostcalculator.com/getInfo.php?domain=' + domain + '&what=all', {
                            onSuccess: function (response) {
                                var html2 = response.responseText;
                                document.getElementById('res').innerHTML = html2;
                                new Ajax.Request('http://sitecostcalculator.com/getCountry.php?domain=' + domain, {
                                    onSuccess: function (response) {
                                        var c = response.responseText;
                                        new Ajax.Request('http://sitecostcalculator.com/sortAllPag.php?domain=' + domain, {
                                            onSuccess: function (response) {
                                                var html3 = response.responseText;
                                                document.getElementById('sortable').innerHTML = html3;
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    }
                });
            } else {
                document.getElementById('res').innerHTML = all;
                new Ajax.Request('http://sitecostcalculator.com/getCountry.php?domain=' + domain, {
                    onSuccess: function (response) {
                        var c = response.responseText;
                        new Ajax.Request('http://sitecostcalculator.com/sortAllPag.php?domain=' + domain, {
                            onSuccess: function (response) {
                                var html3 = response.responseText;
                                document.getElementById('sortable').innerHTML = html3;
                            }
                        });
                    }
                });
            }
        }
    });
}
