/*
Template Name: bitrate - Admin & Dashboard Template
Author: Bitrate
Website: https://Bitrate.com/
Contact: Bitrate@gmail.com
File: Crypto-wallet-init init js
*/

// get colors array from the string
function getChartColorsArray(chartId) {
    if (document.getElementById(chartId) !== null) {
        var colors = document.getElementById(chartId).getAttribute("data-colors");
        if (colors) {
            colors = JSON.parse(colors);
            return colors.map(function (value) {
                var newValue = value.replace(" ", "");
                if (newValue.indexOf(",") === -1) {
                    var color = getComputedStyle(document.documentElement).getPropertyValue(
                        newValue
                    );
                    if (color) return color;
                    else return newValue;
                } else {
                    var val = value.split(",");
                    if (val.length == 2) {
                        var rgbaColor = getComputedStyle(
                            document.documentElement
                        ).getPropertyValue(val[0]);
                        rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
                        return rgbaColor;
                    } else {
                        return newValue;
                    }
                }
            });
        }
    }
}

// Area Chart - Datetime X - Axis
var areachartDatetimeColors = getChartColorsArray("area_chart_datetime");
if (areachartDatetimeColors) {
    var timelinechart = {
        series: [{
            name: "Balance",
            data: [
                [1327359600000, 30.95],
                [1327446000000, 31.34],
                [1327532400000, 31.18],
                [1327618800000, 31.05],
                [1327878000000, 31.0],
                [1327964400000, 30.95],
                [1328050800000, 31.24],
                [1328137200000, 31.29],
                [1328223600000, 31.85],
                [1328482800000, 31.86],
                [1328569200000, 32.28],
                [1328655600000, 32.1],
                [1328742000000, 32.65],
                [1328828400000, 32.21],
                [1329087600000, 32.35],
                [1329174000000, 32.44],
                [1329260400000, 32.46],
                [1329346800000, 32.86],
                [1329433200000, 32.75],
                [1329778800000, 32.54],
                [1329865200000, 32.33],
                [1329951600000, 32.97],
                [1330038000000, 33.41],
                [1330297200000, 33.27],
                [1330383600000, 33.27],
                [1330470000000, 32.89],
                [1330556400000, 33.1],
                [1330642800000, 33.73],
                [1330902000000, 33.22],
                [1330988400000, 31.99],
                [1331074800000, 32.41],
                [1331161200000, 33.05],
                [1331247600000, 33.64],
                [1331506800000, 33.56],
                [1331593200000, 34.22],
                [1331679600000, 33.77],
                [1331766000000, 34.17],
                [1331852400000, 33.82],
                [1332111600000, 34.51],
                [1332198000000, 33.16],
                [1332284400000, 33.56],
                [1332370800000, 33.71],
                [1332457200000, 33.81],
                [1332712800000, 34.4],
                [1332799200000, 34.63],
                [1332885600000, 34.46],
                [1332972000000, 34.48],
                [1333058400000, 34.31],
                [1333317600000, 34.7],
                [1333404000000, 34.31],
                [1333490400000, 33.46],
                [1333576800000, 33.59],
                [1333922400000, 33.22],
                [1334008800000, 32.61],
                [1334095200000, 33.01],
                [1334181600000, 33.55],
                [1334268000000, 33.18],
                [1334527200000, 32.84],
                [1334613600000, 33.84],
                [1334700000000, 33.39],
                [1334786400000, 32.91],
                [1334872800000, 33.06],
                [1335132000000, 32.62],
                [1335218400000, 32.4],
                [1335304800000, 33.13],
                [1335391200000, 33.26],
                [1335477600000, 33.58],
                [1335736800000, 33.55],
                [1335823200000, 33.77],
                [1335909600000, 33.76],
                [1335996000000, 33.32],
                [1336082400000, 32.61],
                [1336341600000, 32.52],
                [1336428000000, 32.67],
                [1336514400000, 32.52],
                [1336600800000, 31.92],
                [1336687200000, 32.2],
                [1336946400000, 32.23],
                [1337032800000, 32.33],
                [1337119200000, 32.36],
                [1337205600000, 32.01],
                [1337292000000, 31.31],
                [1337551200000, 32.01],
                [1337637600000, 32.01],
                [1337724000000, 32.18],
                [1337810400000, 31.54],
                [1337896800000, 31.6],
                [1338242400000, 32.05],
                [1338328800000, 31.29],
                [1338415200000, 31.05],
                [1338501600000, 29.82],
                [1338760800000, 30.31],
                [1338847200000, 30.7],
                [1338933600000, 31.69],
                [1339020000000, 31.32],
                [1339106400000, 31.65],
                [1339365600000, 31.13],
                [1339452000000, 31.77],
                [1339538400000, 31.79],
                [1339624800000, 31.67],
                [1339711200000, 32.39],
                [1339970400000, 32.63],
                [1340056800000, 32.89],
                [1340143200000, 31.99],
                [1340229600000, 31.23],
                [1340316000000, 31.57],
                [1340575200000, 30.84],
                [1340661600000, 31.07],
                [1340748000000, 31.41],
                [1340834400000, 31.17],
                [1340920800000, 32.37],
                [1341180000000, 32.19],
                [1341266400000, 32.51],
                [1341439200000, 32.53],
                [1341525600000, 31.37],
                [1341784800000, 30.43],
                [1341871200000, 30.44],
                [1341957600000, 30.2],
                [1342044000000, 30.14],
                [1342130400000, 30.65],
                [1342389600000, 30.4],
                [1342476000000, 30.65],
                [1342562400000, 31.43],
                [1342648800000, 31.89],
                [1342735200000, 31.38],
                [1342994400000, 30.64],
                [1343080800000, 30.02],
                [1343167200000, 30.33],
                [1343253600000, 30.95],
                [1343340000000, 31.89],
                [1343599200000, 31.01],
                [1343685600000, 30.88],
                [1343772000000, 30.69],
                [1343858400000, 30.58],
                [1343944800000, 32.02],
                [1344204000000, 32.14],
                [1344290400000, 32.37],
                [1344376800000, 32.51],
                [1344463200000, 32.65],
                [1344549600000, 32.64],
                [1344808800000, 32.27],
                [1344895200000, 32.1],
                [1344981600000, 32.91],
                [1345068000000, 33.65],
                [1345154400000, 33.8],
                [1345413600000, 33.92],
                [1345500000000, 33.75],
                [1345586400000, 33.84],
                [1345672800000, 33.5],
                [1345759200000, 32.26],
                [1346018400000, 32.32],
                [1346104800000, 32.06],
                [1346191200000, 31.96],
                [1346277600000, 31.46],
                [1346364000000, 31.27],
                [1346709600000, 31.43],
                [1346796000000, 32.26],
                [1346882400000, 32.79],
                [1346968800000, 32.46],
                [1347228000000, 32.13],
                [1347314400000, 32.43],
                [1347400800000, 32.42],
                [1347487200000, 32.81],
                [1347573600000, 33.34],
                [1347832800000, 33.41],
                [1347919200000, 32.57],
                [1348005600000, 33.12],
                [1348092000000, 34.53],
                [1348178400000, 33.83],
                [1348437600000, 33.41],
                [1348524000000, 32.9],
                [1348610400000, 32.53],
                [1348696800000, 32.8],
                [1348783200000, 32.44],
                [1349042400000, 32.62],
                [1349128800000, 32.57],
                [1349215200000, 32.6],
                [1349301600000, 32.68],
                [1349388000000, 32.47],
                [1349647200000, 32.23],
                [1349733600000, 31.68],
                [1349820000000, 31.51],
                [1349906400000, 31.78],
                [1349992800000, 31.94],
                [1350252000000, 32.33],
                [1350338400000, 33.24],
                [1350424800000, 33.44],
                [1350511200000, 33.48],
                [1350597600000, 33.24],
                [1350856800000, 33.49],
                [1350943200000, 33.31],
                [1351029600000, 33.36],
                [1351116000000, 33.4],
                [1351202400000, 34.01],
                [1351638000000, 34.02],
                [1351724400000, 34.36],
                [1351810800000, 34.39],
                [1352070000000, 34.24],
                [1352156400000, 34.39],
                [1352242800000, 33.47],
                [1352329200000, 32.98],
                [1352415600000, 32.9],
                [1352674800000, 32.7],
                [1352761200000, 32.54],
                [1352847600000, 32.23],
                [1352934000000, 32.64],
                [1353020400000, 32.65],
                [1353279600000, 32.92],
                [1353366000000, 32.64],
                [1353452400000, 32.84],
                [1353625200000, 33.4],
                [1353884400000, 33.3],
                [1353970800000, 33.18],
                [1354057200000, 33.88],
                [1354143600000, 34.09],
                [1354230000000, 34.61],
                [1354489200000, 34.7],
                [1354575600000, 35.3],
                [1354662000000, 35.4],
                [1354748400000, 35.14],
                [1354834800000, 35.48],
                [1355094000000, 35.75],
                [1355180400000, 35.54],
                [1355266800000, 35.96],
                [1355353200000, 35.53],
                [1355439600000, 37.56],
                [1355698800000, 37.42],
                [1355785200000, 37.49],
                [1355871600000, 38.09],
                [1355958000000, 37.87],
                [1356044400000, 37.71],
                [1356303600000, 37.53],
                [1356476400000, 37.55],
                [1356562800000, 37.3],
                [1356649200000, 36.9],
                [1356908400000, 37.68],
                [1357081200000, 38.34],
                [1357167600000, 37.75],
                [1357254000000, 38.13],
                [1357513200000, 37.94],
                [1357599600000, 38.14],
                [1357686000000, 38.66],
                [1357772400000, 38.62],
                [1357858800000, 38.09],
                [1358118000000, 38.16],
                [1358204400000, 38.15],
                [1358290800000, 37.88],
                [1358377200000, 37.73],
                [1358463600000, 37.98],
                [1358809200000, 37.95],
                [1358895600000, 38.25],
                [1358982000000, 38.1],
                [1359068400000, 38.32],
                [1359327600000, 38.24],
                [1359414000000, 38.52],
                [1359500400000, 37.94],
                [1359586800000, 37.83],
                [1359673200000, 38.34],
                [1359932400000, 38.1],
                [1360018800000, 38.51],
                [1360105200000, 38.4],
                [1360191600000, 38.07],
                [1360278000000, 39.12],
                [1360537200000, 38.64],
                [1360623600000, 38.89],
                [1360710000000, 38.81],
                [1360796400000, 38.61],
                [1360882800000, 38.63],
                [1361228400000, 38.99],
                [1361314800000, 38.77],
                [1361401200000, 38.34],
                [1361487600000, 38.55],
                [1361746800000, 38.11],
                [1361833200000, 38.59],
                [1361919600000, 39.6],
            ],
        }, ],
        chart: {
            id: "area-datetime",
            type: "area",
            height: 320,
            zoom: {
                autoScaleYaxis: true,
            },
            toolbar: {
                show: false,
            },
        },
        yaxis: {
            title: {
                text: "$ (thousands)",
            },
        },
        colors: areachartDatetimeColors,
        dataLabels: {
            enabled: false,
        },
        markers: {
            size: 0,
            style: "hollow",
        },
        xaxis: {
            type: "datetime",
            min: new Date("01 Mar 2012").getTime(),
            tickAmount: 6,
        },
        tooltip: {
            x: {
                format: "dd MMM yyyy",
            },
            y: {
                formatter: function (y) {
                    if (typeof y !== "undefined") {
                        return "$" + y.toFixed(2) + "k";
                    }
                    return y;
                },
            },
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.45,
                opacityTo: 0.05,
                stops: [20, 100, 100, 100],
            },
        },
    };

    var timelinechart = new ApexCharts(
        document.querySelector("#area_chart_datetime"),
        timelinechart
    );
    timelinechart.render();
}

// Datetime chart button
var timLine = document.querySelectorAll('.timeline')
if (timLine) {
    var resetCssClasses = function (activeEl) {
        var els = document.querySelectorAll(".timeline");
        Array.prototype.forEach.call(els, function (el) {
            el.classList.remove("active");
        });

        activeEl.target.classList.add("active");
    };
    var OneMonth = document.querySelector("#one_month");
    if (OneMonth) {
        document.querySelector("#one_month").addEventListener("click", function (e) {
            resetCssClasses(e);

            timelinechart.zoomX(
                new Date("28 Jan 2013").getTime(),
                new Date("27 Feb 2013").getTime()
            );
        });
    }
    var SixMonth = document.querySelector("#six_months");
    if (SixMonth) {
        document.querySelector("#six_months").addEventListener("click", function (e) {
            resetCssClasses(e);

            timelinechart.zoomX(
                new Date("27 Sep 2012").getTime(),
                new Date("27 Feb 2013").getTime()
            );
        });
    }
    var OneYear = document.querySelector("#one_year");
    if (OneYear) {
        document.querySelector("#one_year").addEventListener("click", function (e) {
            resetCssClasses(e);
            timelinechart.zoomX(
                new Date("27 Feb 2012").getTime(),
                new Date("27 Feb 2013").getTime()
            );
        });
    }
    var All = document.querySelector("#all");
    if (All) {
        document.querySelector("#all").addEventListener("click", function (e) {
            resetCssClasses(e);

            timelinechart.zoomX(
                new Date("23 Jan 2012").getTime(),
                new Date("27 Feb 2013").getTime()
            );
        });
    }
}

// Bitcoin
var areachartbitcoinColors = getChartColorsArray("bitcoin_sparkline_charts");
if (areachartbitcoinColors) {
    var options = {
        series: [{
            name: "Bitcoin",
            data: [85, 68, 35, 90, 8, 11, 26, 54],
        }, ],
        chart: {
            width: "100%",
            height: 50,
            type: "area",
            sparkline: {
                enabled: true,
            },
            toolbar: {
                show: false,
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: "smooth",
            width: 1.5,
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.45,
                opacityTo: 0.05,
                stops: [50, 100, 100, 100],
            },
        },
        colors: areachartbitcoinColors,
    };
    var chart = new ApexCharts(
        document.querySelector("#bitcoin_sparkline_charts"),
        options
    );
    chart.render();
}

// Litecoin
var areachartlitecoinColors = getChartColorsArray("litecoin_sparkline_charts");
if (areachartlitecoinColors) {
    var options = {
        series: [{
            name: "Litecoin",
            data: [25, 50, 41, 87, 12, 36, 9, 54],
        }, ],
        chart: {
            width: "100%",
            height: 46,
            type: "area",
            sparkline: {
                enabled: true,
            },
            toolbar: {
                show: false,
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: "smooth",
            width: 1.5,
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.45,
                opacityTo: 0.05,
                stops: [50, 100, 100, 100],
            },
        },
        colors: areachartlitecoinColors,
    };
    var chart = new ApexCharts(
        document.querySelector("#litecoin_sparkline_charts"),
        options
    );
    chart.render();
}

// Eathereum
var areacharteathereumColors = getChartColorsArray("eathereum_sparkline_charts");
if (areacharteathereumColors) {
    var options = {
        series: [{
            name: "Eathereum",
            data: [36, 21, 65, 22, 35, 50, 29, 44],
        }, ],
        chart: {
            width: "100%",
            height: 46,
            type: "area",
            sparkline: {
                enabled: true,
            },
            toolbar: {
                show: false,
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: "smooth",
            width: 1.5,
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.45,
                opacityTo: 0.05,
                stops: [50, 100, 100, 100],
            },
        },
        colors: areacharteathereumColors,
    };
    var chart = new ApexCharts(
        document.querySelector("#eathereum_sparkline_charts"),
        options
    );
    chart.render();
}

// Monero
var areachartbinanceColors = getChartColorsArray("binance_sparkline_charts");
if (areachartbinanceColors) {
    var options = {
        series: [{
            name: "Monero",
            data: [30, 58, 29, 89, 12, 36, 9, 54],
        }, ],
        chart: {
            width: "100%",
            height: 46,
            type: "area",
            sparkline: {
                enabled: true,
            },
            toolbar: {
                show: false,
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: "smooth",
            width: 1.5,
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.45,
                opacityTo: 0.05,
                stops: [50, 100, 100, 100],
            },
        },
        colors: areachartbinanceColors,
    };
    var chart = new ApexCharts(
        document.querySelector("#binance_sparkline_charts"),
        options
    );
    chart.render();
}

// Dash
var areachartdashColors = getChartColorsArray("dash_sparkline_charts");
if (areachartdashColors) {
    var options = {
        series: [{
            name: "Dash",
            data: [24, 68, 39, 86, 29, 42, 11, 58],
        }, ],
        chart: {
            width: "100%",
            height: 46,
            type: "area",
            sparkline: {
                enabled: true,
            },
            toolbar: {
                show: false,
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: "smooth",
            width: 1.5,
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.45,
                opacityTo: 0.05,
                stops: [50, 100, 100, 100],
            },
        },
        colors: areachartdashColors,
    };
    var chart = new ApexCharts(
        document.querySelector("#dash_sparkline_charts"),
        options
    );
    chart.render();
}

// Tether
var areacharttetherColors = getChartColorsArray("tether_sparkline_charts");
if (areacharttetherColors) {
    var options = {
        series: [{
            name: "Dash",
            data: [13, 76, 12, 85, 25, 60, 9, 54],
        }, ],
        chart: {
            width: "100%",
            height: 46,
            type: "area",
            sparkline: {
                enabled: true,
            },
            toolbar: {
                show: false,
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: "smooth",
            width: 1.5,
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.45,
                opacityTo: 0.05,
                stops: [50, 100, 100, 100],
            },
        },
        colors: areacharttetherColors,
    };
    var chart = new ApexCharts(
        document.querySelector("#tether_sparkline_charts"),
        options
    );
    chart.render();
}

// Neo
var areachartneoColors = getChartColorsArray("neo_sparkline_charts");
if (areachartneoColors) {
    var options = {
        series: [{
            name: "Neo",
            data: [9, 66, 41, 89, 12, 36, 25, 54],
        }, ],
        chart: {
            width: "100%",
            height: 46,
            type: "area",
            sparkline: {
                enabled: true,
            },
            toolbar: {
                show: false,
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: "smooth",
            width: 1.5,
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.45,
                opacityTo: 0.05,
                stops: [50, 100, 100, 100],
            },
        },
        colors: areachartneoColors,
    };
    var chart = new ApexCharts(
        document.querySelector("#neo_sparkline_charts"),
        options
    );
    chart.render();
}

// Swiper Slider
var swiper = new Swiper(".cryptoSlider", {
    slidesPerView: 1,
    spaceBetween: 24,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    breakpoints: {
        640: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        },
        1600: {
            slidesPerView: 4,
        },
    },
});

// List Js
var perPage = 6;

//Table
var options = {
    valueNames: [
        "id",
        "currency_name",
        "quantity_value",
        "avg_price",
        "current_value",
        "returns",
        "returns_per",
    ],
    page: perPage,
    pagination: true,
    plugins: [
        ListPagination({
            left: 2,
            right: 2,
        }),
    ],
};

// Init list
var MarketList = document.getElementById('marketList');
if (MarketList) {
    var marketList = new List("marketList", options).on("updated", function (list) {
        list.matchingItems.length == 0 ?
            (document.getElementsByClassName("noresult")[0].style.display = "block") :
            (document.getElementsByClassName("noresult")[0].style.display = "none");
        var isFirst = list.i == 1;
        var isLast = list.i > list.matchingItems.length - list.page;
        // make the Prev and Nex buttons disabled on first and last pages accordingly
        document.querySelector(".pagination-prev.disabled") ?
            document.querySelector(".pagination-prev.disabled").classList.remove("disabled") : "";
        document.querySelector(".pagination-next.disabled") ?
            document.querySelector(".pagination-next.disabled").classList.remove("disabled") : "";
        if (isFirst) {
            document.querySelector(".pagination-prev").classList.add("disabled");
        }
        if (isLast) {
            document.querySelector(".pagination-next").classList.add("disabled");
        }
        if (list.matchingItems.length <= perPage) {
            document.querySelector(".pagination-wrap").style.display = "none";
        } else {
            document.querySelector(".pagination-wrap").style.display = "flex";
        }

        if (list.matchingItems.length > 0) {
            document.getElementsByClassName("noresult")[0].style.display = "none";
        } else {
            document.getElementsByClassName("noresult")[0].style.display = "block";
        }
    });

    isCount = new DOMParser().parseFromString(
        marketList.items.slice(-1)[0]._values.id,
        "text/html"
    );
}

var paginationNext = document.querySelector(".pagination-next");
if (paginationNext) {
    document.querySelector(".pagination-next").addEventListener("click", function () {
        document.querySelector(".pagination.listjs-pagination") ?
            document.querySelector(".pagination.listjs-pagination").querySelector(".active") ?
            document.querySelector(".pagination.listjs-pagination").querySelector(".active").nextElementSibling.children[0].click() :
            "" :
            "";
    });
}

var paginationPrev = document.querySelector(".pagination-prev");
if (paginationPrev) {
    document.querySelector(".pagination-prev").addEventListener("click", function () {
        document.querySelector(".pagination.listjs-pagination") ?
            document.querySelector(".pagination.listjs-pagination").querySelector(".active") ?
            document.querySelector(".pagination.listjs-pagination").querySelector(".active").previousSibling.children[0].click() :
            "" :
            "";
    });
}