





/* FILE: /js/jquery/plugins/urlencode/urlEncode.js */
jQuery.extend({URLEncode:function(c){var o='';var x=0;c=c.toString();var r=/(^[a-zA-Z0-9_.]*)/;
  while(x<c.length){var m=r.exec(c.substr(x));
    if(m!=null && m.length>1 && m[1]!=''){o+=m[1];x+=m[1].length;
    }else{if(c[x]==' ')o+='+';else{var d=c.charCodeAt(x);var h=d.toString(16);
    o+='%'+(h.length<2?'0':'')+h.toUpperCase();}x++;}}return o;},
URLDecode:function(s){var o=s;var binVal,t;var r=/(%[^%]{2})/;
  while((m=r.exec(o))!=null && m.length>1 && m[1]!=''){b=parseInt(m[1].substr(1),16);
  t=String.fromCharCode(b);o=o.replace(m[1],t);}return o;}
});



    ;Infusion.scriptLoaded('/js/jquery/plugins/urlencode/urlEncode.js');
    


/* FILE: /js/utils_string.js */

Infusion("StringUtils", function() {

    var ns = Infusion.StringUtils;

    ns.is = is;
    ns.nz = nz;
    ns.abbreviate = abbreviate;
    ns.startsWith = startsWith;
    ns.endsWith = endsWith;
    ns.contains = contains;
    ns.containsNonAlphaNumeric = containsNonAlphaNumeric;
    ns.replaceAll = replaceAll;
    ns.equalsIgnoreCase = equalsIgnoreCase;
    ns.removeWhitespace = removeWhitespace;
    ns.removeNonAlphaNumeric = removeNonAlphaNumeric;
    ns.firstLetterUpper = firstLetterUpper;
    ns.count = count;
    ns.plural = plural;
    ns.isOrAre = isOrAre;
    ns.haveOrHas = haveOrHas;
    ns.possessive = possessive;
    ns.parentheses = parentheses;
    ns.isPrepend = isPrepend;
    ns.isAppend = isAppend;
    ns.minLength = minLength;
    ns.insertNewlines = insertNewlines;

    function is(str) {
        return str != undefined && str != null && str != "" && str != "null" && str != "undefined";
    }

    function nz(str, backup) {
        return is(str) ? "" + str :
               is(backup) ? "" + backup : "";
    }
    
    function abbreviate(text, maxLength) {
        if(text==undefined) text = '';
        if(text.length > maxLength) text = text.substring(0, maxLength - 1) + "...";
        return text;
    }

    function startsWith(str, pattern) {
        if (str == null || str == undefined || pattern == null) return false;
        return str.length >= pattern.length && str.toLowerCase().indexOf(pattern.toLowerCase()) == 0;
    }

    function endsWith(str, pattern) {
        if (str == null || str == undefined || pattern == null) return false;
        var d = str.length - pattern.length;
        return d >= 0 && str.toLowerCase().lastIndexOf(pattern.toLowerCase()) === d;
    }

    function contains(str, pattern) {
        if (str == null || str == undefined || pattern == null) return false;
        var d = str.length - pattern.length;
        return d >= 0 && str.toLowerCase().lastIndexOf(pattern.toLowerCase()) >= 0;
    }

    function containsNonAlphaNumeric(str) {
        var stripped = removeNonAlphaNumeric(str);
        return str != stripped;
    }

    function replaceAll(str, s1, s2) {
        return nz(str).split(s1).join(s2);
    }

    function equalsIgnoreCase(str1, str2) {
        return nz(str1).toLowerCase() == nz(str2).toLowerCase()
    }

    function removeWhitespace(str) {
        return nz(str).replace(/\s+/g, '');
    }

    function removeNonAlphaNumeric(str) {
        return nz(str).replace(/[^A-Za-z0-9]/g, '');
    }

    function firstLetterUpper(str) {
        var nullSafe = nz(str);
        return nullSafe.charAt(0).toUpperCase() + nullSafe.slice(1);
    }

    function count(num, str) {
        return num + " " + plural(str, num);
    }

    function plural(str, count) {
        var num = Infusion.Utils.useDefaultIfNotDefined(count, 2);
        var ret;

        if (num == 1 || !is(str)) {
            ret = nz(str);

        } else {
            var t = getLastCharacter(str);

            if (t == 'x' || t == 's' || t == 'i' || endsWith(str, "ch") || endsWith(str, "sh")) {
                ret = str + "es";

            } else if (t == 'y' || t == 'Y') {
                var e = str.charAt(str.length - 2);

                if (isVowel(e)) {
                    ret = str + "s";

                } else {
                    ret = str.substring(0, str.length - 1) + "ies";
                }

            } else {
                ret = str + "s";
            }
        }

        return ret;
    }

    function getLastCharacter(str) {
        return str.charAt(str.length - 1);
    }

    function isVowel(letter) {
        return letter == 'a' || letter == 'e' || letter == 'i' || letter == 'o' || letter == 'u' ||
            letter == 'A' || letter == 'E' || letter == 'I' || letter == 'O' || letter == 'U';
    }

    function isOrAre(count) {
        return count == 1 ? "is" : "are";
    }

    function haveOrHas(count) {
        return count == 1 ? "has" : "have";
    }

    function possessive(str) {
        var ret;

        if (!is(str)) {
            ret = nz(str);

        } else {
            var t = getLastCharacter(str);

            if (t == 's' || t == 'S') {
                ret = str + "'";

            } else {
                ret = str + "'s";
            }
        }

        return ret;
    }

    function parentheses(str) {
        var ret;

        if (!is(str)) {
            ret = nz(str);

        } else {
            ret = "(" + str + ")";
        }

        return ret;
    }

    function isPrepend(str1, str2) {
        var ret = "";

        if (is(str1)) {
            ret = nz(str2) + str1;
        }

        return ret;
    }

    function isAppend(str1, str2) {
        var ret = "";

        if (is(str1)) {
            ret = str1 + nz(str2);
        }

        return ret;
    }

    function minLength(str, min, c) {
        var ret = "";
        var length = is(str) ? str.length : 0;
        for (var i = min; i > length; i--) {
            ret += c;
        }
        return ret + nz(str);
    }

    function insertNewlines(str, maxLineLength) {
        var ret = "";

        if (is(str)) {
            ret = str;
            var lastNewline = 0;
            var lastSpace = 0;
            var lineLength = 0;

            for (var i = 0; i < ret.length; i++) {
                var c = ret.charAt(i);

                if (c == " ") {
                    lastSpace = i;

                } else if (c == "\n") {
                    lastNewline = i;
                }

                if (lineLength >= maxLineLength) {
                    ret = ret.substr(0, lastSpace) + "\n" + ret.substr(lastSpace + 1);
                    lastNewline = lastSpace;
                }

                lineLength = i - lastNewline;
            }
        }

        return ret;
    }

});

    ;Infusion.scriptLoaded('/js/utils_string.js');
    


/* FILE: /js/utils_ui.js */
Infusion("UI", function() {

    var ns = Infusion.UI;

    ns.registerTextWithDefault = registerTextWithDefault;
    ns.showHide = showHide;
    ns.show = show;
    ns.hide = hide;
    ns.displayWarning = displayWarning;
    ns.setWarningText = setWarningText;
    ns.hideWarning = hideWarning;
    ns.setNotice = setNotice;
    ns.clearNotice = clearNotice;
    ns.notice = notice;
    ns.createSplitButton = createSplitButton;

    var textDefaults = {};

    function registerTextWithDefault(textId, defaultVal) {
        textDefaults[textId] = defaultVal;

        var jText = jQuery("[id='" + textId + "']");
        defaultIfBlank(jText);
        toggleTextWithDefault(jText);

        jText.bind("focus", function() {
            blankIfDefault(jText);
            toggleTextWithDefault(jText);
        });
        jText.bind("blur", function() {
            defaultIfBlank(jText);
            toggleTextWithDefault(jText);
        });

        var text = jText.get(0);
        if (text && text.form) {
            jQuery(text.form).bind("submit", function() {
                blankIfDefault(jText);
            });
            jQuery(text.form).bind("serialize", function() {
                blankIfDefault(jText);
            });
            jQuery(text.form).bind("ajax-submit", function() {
                blankIfDefault(jText);
            });
        }
    }

    function defaultIfBlank(jText) {
        var defaultVal = getDefaultVal(jText);
        if (!Infusion.StringUtils.is(jText.val())) {
            jText.val(defaultVal);
            jText.attr("defaulttext", true);
        }
    }

    function blankIfDefault(jText) {
        var defaultVal = getDefaultVal(jText);
        if (jText.val() == defaultVal) {
            jText.val("");
            jText.removeAttr("defaulttext");
        }
    }

    function toggleTextWithDefault(jText) {
        var defaultVal = getDefaultVal(jText);
        if (jText.val() == defaultVal) {
            jText.addClass("lightText");
        } else {
            jText.removeClass("lightText");
        }
    }

    function getDefaultVal(jText) {
        // must get the dom element and pull the id from it vs. using jquery
        var id = jText.get(0).id;
        return textDefaults[id];
    }

    function showHide(className, show) {
        className = '.' + className;
        if (show) {
            jQuery(className).removeClass('inf-hide');
        } else {
            jQuery(className).addClass('inf-hide');
        }
    }

    function show(className) {
        showHide(className, true);
    }

    function hide(className) {
        showHide(className, false);
    }

    function displayWarning() {
        document.getElementById("warningDiv").className = "warningDiv";
    }

    function setWarningText(text) {
        document.getElementById("warningText").innerHTML = text;
    }

    function hideWarning() {
        document.getElementById("warningDiv").className = "hideWarning";
    }

    function setNotice(notice, type) {
        jQuery("html,body").stop();
        jQuery("html, body").stop();
        jQuery("html,body").animate({scrollTop: 0}, 1000);
    }

    function clearNotice() {
        jQuery("#noticeSpan").html("");
    }

    function notice(options) {
        //Load the CSS first

        jQuery("head").append("<link>");
        var css = jQuery("head").children(":last");

        css.attr({
            rel:  "stylesheet",
            type: "text/css",
            href: "/resources/component/content/notice/notice.css"
        });

        var body = options.body ? options.body : "No notice";
        var type = options.type ? options.type : "warning";
        var includeImage = (options.includeImage != null || options.includeImage != undefined) ? options.includeImage : true;
        var width = options.width ? options.width : null;

        var $noticeTable = jQuery("table#notice").length == 0 ? jQuery("<table></table>").attr("id", "notice") :
            jQuery("table#notice");
        var $noticeTableRow = jQuery("<tr></tr>");
        var $iconCell = jQuery("<td></td>").attr("id", "noticeIcon");
        var $noticeCell = jQuery("<td></td>").attr("id", "noticeText");

        $noticeTable.removeClass().addClass("block-notice-table").addClass("block-notice-" + type);

        if (width != null) {
            $noticeTable.width(width);
        }

        if (includeImage) {
            var $icon = jQuery("<img />").attr("src", "/slices/style/" + type + ".png");
            $iconCell.removeClass().addClass("block-notice-cell").addClass("block-notice-cell-" + type).addClass("block-notice-icon");
            $iconCell.append($icon);
            $noticeTableRow.append($iconCell);
        }

        $noticeCell.removeClass().addClass("block-notice-cell").addClass("block-notice-cell-" + type).addClass("block-notice-text").html(body);

        $noticeTableRow.append($noticeCell);

        $noticeTable.html("").append($noticeTableRow);

        return $noticeTable;
    }

    function createSplitButton(id, options) {
        var defaultOptions = {
            type: "split",
            sTitle: false
        };
        var buttonOptions = jQuery.extend({}, defaultOptions, options);

        var splitButton = new YAHOO.widget.Button(id, buttonOptions);
        splitButton.addClass("inf-button menu-button");
        splitButton.OPTION_AREA_WIDTH = 30;

        return splitButton;
    }

});

    ;Infusion.scriptLoaded('/js/utils_ui.js');
    


/* FILE: /js/utils_event.js */
Infusion("Event", function() {

    var ns = Infusion.Event;

    ns.registerEventHandler = registerEventHandler;
    ns.unregisterEventHandlers = unregisterEventHandlers;
    ns.handleEvent = handleEvent;
    ns.getHandleEventClosure = getHandleEventClosure;
    
    function getEventer() {
        return jQuery("html");
    }

    function registerEventHandler(event, handler) {
        var eventer = getEventer();        
        eventer.bind(event, handler);
    }

    function unregisterEventHandlers(event){
        var eventer = getEventer();
        eventer.unbind(event);
    }

    function handleEvent(event) {
        var eventer = getEventer();
        eventer.trigger(event);
    }

    function getHandleEventClosure(event){
        return function() {
            handleEvent(event);
        };
    }

});

    ;Infusion.scriptLoaded('/js/utils_event.js');
    


/* FILE: /js/utils_jquery.js */
Infusion("jQuery", function() {

    var ns = Infusion.jQuery;

    ns.exists = exists;
    ns.getRadioVal = getRadioVal;
    ns.setRadioVal = setRadioVal;
    ns.isChecked = isChecked;
    ns.setChecked = setChecked;
    ns.escapeHtml = escapeHtml;
    ns.unescapeHtml = unescapeHtml;

    function exists(selector) {
        return jQuery(selector).get(0) != null;
    }

    function getRadioVal(name) {
        return jQuery("input[name=" + name + "]:checked").val();
    }

    function setRadioVal(name, val) {
        jQuery("input[name=" + name + "]").each(function() {
            var _this = jQuery(this);
            if (_this.val() == val) {
                _this.attr("checked", true);
            } else {
                _this.attr("checked", false);
            }
        });
    }

    function isChecked(id) {
        return jQuery("#" + id).is(":checked");
    }

    function setChecked(id, checked) {
        return jQuery("#" + id).attr("checked", checked);
    }

    function escapeHtml(html) {
        return jQuery("<div />").text(html).html();
    }

    function unescapeHtml(html) {
        return jQuery("<div />").html(html).text();
    }

});

    ;Infusion.scriptLoaded('/js/utils_jquery.js');
    


/* FILE: /js/utils_url.js */
Infusion("Url", function() {

    var ns = Infusion.Url;

    ns.getViewUrl = getViewUrl;
    ns.getJsonUrl = getJsonUrl;
    ns.param = param;
    ns.appendParam = appendParam;
    ns.checkForAndCreateHttpIfNoneExists = checkForAndCreateHttpIfNoneExists;

    var extension_json = "json";

    function getViewUrl(controller, action, id) {
        return getUrl(controller, action, null, id);
    }

    function getJsonUrl(controller, action) {
        return getUrl(controller, action, extension_json);
    }

    function getUrl(controller, action, extension, id) {
        var url = "/app/" + controller + "/" + action;

        if (extension && extension != "") {
            url += "." + extension;

        } else if(id && id != '') {
            url += "/" + id
        }

        return url;
    }

    function param(key, value) {
        return key + "=" + value;
    }

    function appendParam(url, key, value) {
        var symbol = Infusion.StringUtils.contains(url, "?") ? "&" : "?";

        return url + symbol + param(key, value);
    }

    function checkForAndCreateHttpIfNoneExists(url) {
        var lowercaseUrl = url.toLowerCase();
        var prefix = lowercaseUrl.substring(0, 8);

        if (prefix.indexOf("http://") == -1 && prefix.indexOf("https://") == -1) {
            lowercaseUrl = "https://" + lowercaseUrl;
        }

        return lowercaseUrl;
    }

});

    ;Infusion.scriptLoaded('/js/utils_url.js');
    


/* FILE: /js/utils_html.js */
Infusion("HTML", function() {

    var ns = Infusion.HTML;

    ns.createDiv = createDiv;
    ns.wrapInDiv = wrapInDiv;
    ns.wrapInTable = wrapInTable;
    ns.wrapInTr = wrapInTr;
    ns.wrapInTd = wrapInTd;
    ns.wrapInA = wrapInA;
    ns.createImg = createImg;
    ns.createCheckbox = createCheckbox;

    function createDiv(id, html, css, onclick) {
        var div = "<div id='" + id + "'";
        if (Infusion.StringUtils.is(css)) {
            div += " class='" + css + "'";
        }
        if (Infusion.StringUtils.is(onclick)) {
            div += " onclick=\"" + onclick + "\"";
        }
        div += ">" + html + "</div>";

        return div;
    }

    function wrapInDiv(html, css) {
        return Infusion.StringUtils.is(css) ?
            "<div class='" + css + "'>" + html + "</div>" :
            "<div>" + html + "</div>";
    }

    function wrapInTable(html, css) {
        return Infusion.StringUtils.is(css) ?
            "<table class='" + css + "'>" + html + "</table>" :
            "<table>" + html + "</table>";
    }

    function wrapInTr(html) {
        return "<tr>" + html + "</tr>";
    }

    function wrapInTd(html, css) {
        return Infusion.StringUtils.is(css) ?
            "<td class='" + css + "'>" + html + "</td>" :
            "<td>" + html + "</td>";
    }

    function wrapInA(url, html) {
        return "<a href='" + url + "'>" + html + "</a>";
    }

    function createImg(icon, height, width) {
        var html = "<img src='" + icon + "' ";

        if (height) {
            html += " height='" + height + "' ";
        }

        if (height) {
            html += " width='" + width + "' ";
        }

        return html + "/>";
    }

    function createCheckbox(id, checked, onclick) {
        var html = "<input type=\"checkbox\" id=\"" + id + "\"";

        if (checked) {
            html += " checked=\"true\"";
        }

        if (Infusion.StringUtils.is(onclick)) {
            html += " onclick=\"" + onclick + "\"";
        }

        html += "/>";

        return html;
    }

});

    ;Infusion.scriptLoaded('/js/utils_html.js');
    


/* FILE: /js/utils_collection.js */

Infusion("CollectionUtils", function() {

    var ns = Infusion.CollectionUtils;

    ns.contains = contains;
    ns.containsAny = containsAny;
    ns.toStr = toStr;
    ns.executeOnAll = executeOnAll;
    ns.executeOnAllFiltered = executeOnAllFiltered;
    ns.executeAll = executeAll;
    ns.allowAnyFilter = allowAnyFilter;
    ns.add = add;
    ns.addAll = addAll;
    ns.remove = remove;

    function contains(array, value) {
        return is(array) && is(value) && array.indexOf(value) > -1;
    }

    function is(obj) {
        return obj != null && obj != undefined;
    }

    function containsAny(array1, array2) {
        var containsAny = false;

        if (array1 && array2) {
            executeOnAll(array2, function(value) {
                containsAny = containsAny || contains(array1, value);
            });
        }

        return containsAny;
    }

    function toStr(array, addNewLineAfter, formatter) {
        var ret = null;

        if (array) {
            ret = "";

            var c = 0;
            for (var i=0; i<array.length; i++) {
                c++;
                var val = array[i];

                if (formatter) {
                    val = formatter(val);
                }

                var isNextToLast = array.length > 1 && i == array.length - 2;
                var isLast = array.length > 0 && i == array.length - 1;

                var newline;

                if (addNewLineAfter && c >= addNewLineAfter) {
                    newline = "\n";
                    c = 0;  // reset counter

                } else {
                    newline = "";
                }

                var or = array.length > 2 ? ", " + newline + "or " : newline + " or ";
                ret += val + (isNextToLast ? or : isLast ? "" : ", " + newline);
            }
        }

        return Infusion.StringUtils.nz(ret);
    }

    function executeOnAll(array, callback) {
        executeOnAllFiltered(array, allowAnyFilter, callback);
    }

    function allowAnyFilter(item) {
        return true;
    }

    function executeOnAllFiltered(array, filter, callback) {
        if (array) {
            for (var i = 0; i<array.length; i++) {
                var item = array[i];

                if (item && filter && callback && filter(item)) {
                    callback(item);
                }
            }
        }
    }

    function executeAll(arrayOfCallbacks) {
        executeOnAll(arrayOfCallbacks, function(callback) {
            callback();
        });
    }

    function add(array, value) {
        if (array && value) {
            array.push(value);
        }
    }

    function addAll(array1, array2) {
        if (array1 && array2) {
            executeOnAll(array2, function(item) {
                add(array1, item);
            });
        }
    }

    function remove(array, value) {
        if (array && value) {
            var index = array.indexOf(value);

            if (index > -1) {
                array.splice(index, 1);
            }
        }
    }

});

    ;Infusion.scriptLoaded('/js/utils_collection.js');
    


/* FILE: /js/utils_number.js */

Infusion("NumberUtils", function() {

    var ns = Infusion.NumberUtils;

    ns.useZeroIfUndefined = useZeroIfUndefined;
    ns.suffix = suffix;
    ns.isValidLongId = isValidLongId;
    ns.ensureLongEndsWithL = ensureLongEndsWithL;
    ns.removeLongSuffix = removeLongSuffix;
    ns.removeLongSuffixFromArray = removeLongSuffixFromArray;

    var LONG_SUFFIX = "L";

    function useZeroIfUndefined(num) {
        return defined(num) ? num : 0;
    }

    function defined(num) {
        return num != null && num != undefined && num != "";
    }

    function suffix(num) {
        var ret = "";

        if (num != null && num != undefined) {
            var lastDigit = -1;

            if (num.length > 1) {
                lastDigit = num.charAt(num.length - 1);

            } else if (num.length > 0) {
                lastDigit = num.charAt(0);
            }

            if (num != 11 && lastDigit == 1) {
                ret = "st";

            } else if (num != 12 && lastDigit == 2) {
                ret = "nd";

            } else if (lastDigit == 3) {
                ret = "rd";

            } else {
                ret = "th";
            }
        }

        return ret;
    }

    function isValidLongId(val) {
        return isValidPositiveLongId(val);
    }

    function isValidPositiveLongId(val) {
        return removeLongSuffix(val) > 0;
    }

    function ensureLongEndsWithL(val) {
        return endsWithL(val) ? val : val + LONG_SUFFIX;
    }

    function endsWithL(val) {
        return Infusion.StringUtils.endsWith(val, LONG_SUFFIX);
    }

    function removeLongSuffixFromArray(array) {
        var newArray = new Array();

        for (var i=0; i < array.length; i++) {
            newArray.push(removeLongSuffix(array[i]));
        }

        return newArray;
    }

    function removeLongSuffix(val) {
        return endsWithL(val) ? val.substring(0, val.length - 1) : val;
    }

});

    ;Infusion.scriptLoaded('/js/utils_number.js');
    


/* FILE: /resources/popup/popup.js */
Infusion("Popup", function() {

    var ns = Infusion.Popup;

    ns.open = open;
    ns.refreshMainOnPopupClose = refreshMainOnPopupClose;
    ns.refreshMainOnPopupCloseCheck = refreshMainOnPopupCloseCheck;
    ns.showPopUpsBlockedMessage = showPopUpsBlockedMessage;
    ns.openActivationLightBox = openActivationLightBox;
    ns.openImportSoftLimitReachedWarning = openImportSoftLimitReachedWarning;
    ns.openActivateNow = openActivateNow;
    ns.closeLightBox = closeLightBox;
    ns.isLightBoxVisible = isLightBoxVisible;
    ns.popSimpleLightbox = popSimpleLightbox;
    ns.popLightbox = popLightbox;
    ns.popLightboxIFrame = popLightboxIFrame;

    var popupsBlockedLightBox;
    var isDomElement = false;

    /**
     * Infusion.Popup.open function finds takes a url and an optional configuration and opens a popup window
     *
     * <pre>
     * Infusion.Popup.open('https://shawnl:8443/Appointment/manageAppointment.jsp?view=add',
     *                           {name:'Appointment', height: 1000, width: 750});
     * </pre>
     * @method open
     * @param  {url} URL to open
     *         {Object} Configuration object where property names match the window.open properties:
     *                       location, menubar, resizable, scrollbars, status, titlebar, toolbar, top, width, height, left
     *                  and
     *                       name (window name to open)
     * @return {Window}  Returns a reference to the popup window
     */
    function open(url, cfgOverride) {
        var possibleWindowProperties = {
            location:true, menubar:true, resizable:true, scrollbars:true, status:true,
            titlebar:true, toolbar:true, top:true, width:true, height:true, left:true
        };
        var cfg = {
            scrollbars: 'yes',
            resizable: 'yes',
            height: 600,
            width: 800
        };
        var cfgOverride = (cfgOverride) ? cfgOverride : {};
        var windowName = (cfgOverride.name) ? cfgOverride.name : "_blank";
        for (var i in cfgOverride) {
            cfg[i] = cfgOverride[i];
        }
        if (cfg.top == undefined) {
            cfg.top = parseInt((screen.height - parseInt(cfg.height, 10)) / 2, 10);
        }
        if (cfg.left == undefined) {
            cfg.left = parseInt((screen.width - parseInt(cfg.width, 10)) / 2, 10);
        }
        var winProp = "";
        for (var prop in cfg) {
            if (possibleWindowProperties[prop]) {
                winProp += "," + prop + "=" + cfg[prop];
            }
        }
        winProp = winProp.substring(1);
        var winRef = window.open(url, windowName, winProp);
        if (window.focus) {
            winRef.focus();
        }

    }

    function refreshMainOnPopupClose(tabParam) {
        tabParam = (tabParam) ? tabParam : "";
        if (window.opener) {
            var main = window.opener;
            main.popUpWindowRef = window;
            main.setTimeout('Infusion.Popup.refreshMainOnPopupCloseCheck("' + tabParam + '")', 100);
        }
    }

    function refreshMainOnPopupCloseCheck(tabParam) {
        if (window.popUpWindowRef) {
            if (window.popUpWindowRef.closed && tabParam != '') {
                var loc = location.href;
                if (loc.indexOf('tabs_sel') == -1) {
                    if (loc.indexOf('?') == -1) {
                        loc += '?';
                    }
                    else {
                        loc += '&';
                    }
                    loc += 'tabs_sel=' + tabParam;
                }
                else {
                    var TabSelRE = /tabs_sel=[^&]*/;
                    loc = loc.replace(TabSelRE, 'tabs_sel=' + tabParam);
                }
                // Remove any previous Message
                if (loc.indexOf('msg=') > -1) {
                    var MsgRE = /msg=[^&]*/;
                    loc = loc.replace(MsgRE, '');
                }
                location.href = loc;
            } else if (window.popUpWindowRef.closed) {
                location.reload();
            } else {
                setTimeout('Infusion.Popup.refreshMainOnPopupCloseCheck("' + tabParam + '")', 100);
            }
        }
    }

    function showPopUpsBlockedMessage() {
        if (!popupsBlockedLightBox) {
            popupsBlockedLightBox = popLightbox("It looks like your browser blocked our pop-up",
                '/template/include/popUpBlockerDetected.jsp',
                {width: "480px", height: "150px", startcentered:true, dragable: true});
        }
    }

    function openImportSoftLimitReachedWarning(current, wizardCount) {
        return lightbox = popLightbox('', '/Import/step/include/importSoftLimitReachedWarning.jsp?current=' + current + '&wizardCount=' + wizardCount, {
            width: "650px",
            height: "auto",
            startcentered:true
        });
    }

    function openActivationLightBox(returnTo, emailOrContact, max, current, currentPlusImport) {
        popLightbox('', '/Trials/activationLightBox.jsp?returnTo=' + returnTo + '&emailOrContact=' + emailOrContact + '&max=' + max + '&current=' + current + '&currentPlusImport=' + currentPlusImport, {
            width: "650px",
            height: "auto",
            startcentered:true
        });
    }

    function openActivateNow(title, url) {
        popLightbox(title, url, {
            width: "650px",
            height: "auto",
            startcentered:true
        });
    }

    function openLightbox(fillDivId, url, config, contentId, data) {
        if (data) {
            url = data.includePage
        } else {
            url = null;
        }

        config = config || {};
        contentId = contentId || fillDivId;
        data = data || {};
        data.timestamp = new Date().getTime();  // IE will cache the ajax call unless the url changes

        var $doc = jQuery(document);
        var $win = jQuery(window);
        var $container = jQuery('#' + fillDivId);

        /* Set Default Config settings
         see http://developer.yahoo.com/yui/container/panel/index.html for full list of YUI Panel options
         */
        var defaultConfig = {
            fixedcenter:true,
            width: "640px",
            height: "480px",
            bodyPadding: "10",
            close: true,
            draggable: false,
            zindex: 999,
            modal: true,
            visible: false,
            maximize: false,
            destroyOnClose: false,
            noWidthCalculation: false
        };
        config = YAHOO.lang.merge(defaultConfig, config);

        // todo: make it so the X will restore this and turn it back on
        //        jQuery("body").css("overflow", "hidden");

        if (config.maximize) {
            config.height = parseInt($win.height());
            config.width = parseInt($win.width());
        }

        if (url) {
            if (config.useiframe) {
                $container.append("<iframe id='iframe_" + fillDivId + "'name='iframe_" + fillDivId + "' scrolling='no' frameborder='0' height='" + (config.height) + "px' width='" + (config.width) + "px' src='../previewOrderForm_files/"%20+%20url%20+%20"'></iframe>");
            } else {
                jQuery.ajax({
                    type: "GET",
                    async: false,
                    dataType: "html",
                    data: data,
                    cache: false,
                    'url': url,
                    success: function(msg) {
                        $doc.trigger("beforeAjaxFill", $container.get(0));
                        $container.html(getLightboxHTML(data.title, msg, config));
                        $doc.trigger("ajaxFill", $container.get(0));
                    }
                });
            }
        } else if (data.content.tagName || data.content.nodeName) {
            $doc.trigger("beforeAjaxFill", $container.get(0));
            $container.html(getLightboxHTML(data.title, "", config));
            $doc.trigger("ajaxFill", $container.get(0));
            isDomElement = true;
        } else {
            $doc.trigger("beforeAjaxFill", $container.get(0));
            $container.html(getLightboxHTML(data.title, data.content, config));
            $doc.trigger("ajaxFill", $container.get(0));
        }

        // you can't get the content until AFTER the ajax
        var $content = jQuery('#' + contentId);
        var autoWidth = !config.width || config.width == "auto";

        // Center Panel within the viewport when the function is called (can scroll without Panel moving)
        if (config.startcentered) {
            calculateLocation(config, $content, $win, $doc);
        }

        if (config.minY && config.y > config.minY) {
            config.y = config.minY;
        }

        var lightboxPanel = new YAHOO.widget.Panel(contentId, config);
        lightboxPanel.render();

        if (isDomElement) {
            jQuery("#theLightboxContent").append(jQuery(data.content).show());
        }

        lightboxPanel.dataContent = data.content;
        lightboxPanel.show();

        if (config.destroyOnClose) {
            lightboxPanel.hideEvent.subscribe(function () {
                setTimeout(function() {
                    closeLightBox(lightboxPanel);
                }, 0);
            });
        }

        //if data content is a dom element, we need to move it instead of destroying it outright
        if (isDomElement) {
            lightboxPanel.hideEvent.subscribe(function() {
                setTimeout(function() {
                    moveDataContentDiv(lightboxPanel);
                }, 0);
            });
        }

        if (config.startcentered && autoWidth) {
            // need to recalc after rendering w/ auto width or auto height
            calculateLocation(config, $content, $win, $doc);
            jQuery('#' + contentId + "_c").css("left", config.x);

            // fix for IE
            if (!config.noWidthCalculation) {
                var width = calculateWidth(config, $content);
                $content.width(width);
            }
        }

        lightboxPanel.hideEvent.subscribe(function() {
            $doc.trigger("beforeLightboxClose", [document.getElementById(contentId)]);
        });

        lightboxPanel.maxWithPadding = function() {
            var h = parseInt(YAHOO.util.Dom.getClientHeight());
            var w = parseInt(YAHOO.util.Dom.getClientWidth());
            jQuery("#iframe_" + fillDivId)
                .attr("height", h)
                .attr("width", w);
        };

        if (config.draggable) {
            jQuery("#theLightbox").draggable({
                zIndex: 20,
                ghosting: false,
                opacity: 0.7,
                containment: "document",
                handle: ".hd"
            });
            jQuery("#theLightbox div.hd").css("cursor", "move");
        }

        // if you don't redirect the focus, pressing enter often opens another copy of the lightbox
        jQuery("#theLightbox_focus").focus();

        return lightboxPanel;
    }

    function getLightboxHTML(title, msg, config) {
        var html = '';
        html += '<div id="theLightbox">' +
            '<a id="theLightbox_focus" href="#"/>';

        if (title != null && typeof title !== "undefined" && title.replace(/ /g, "").length > 0) {
            html += '<div class="hd">' + title + '</div>';
        }

        html += '<div id="theLightboxContent" class="bd" style="padding:' + config.bodyPadding + 'px">' + msg + '</div>' +
            '</div>';

        return html;
    }

    function calculateWidth(config, $content) {
        return parseInt(config.width, 10) || $content.width();
    }

    function calculateHeight(config, $content) {
        return parseInt(config.height, 10) || $content.height();
    }

    function calculateLocation(config, $content, $win, $doc) {
        config.fixedcenter = false; // fixedcenter = true will keep this from working

        var left = 10;
        var availableWidth = $win.width() - calculateWidth(config, $content);
        if (availableWidth > 20) {
            left = parseInt(availableWidth / 2, 10);
        }
        var top = 10;
        var availableHeight = $win.height() - calculateHeight(config, $content);
        if (availableHeight > 20) {
            top = parseInt(availableHeight / 2, 10);
        }

        config.x = left + ($doc.scrollLeft());
        config.y = top + ($doc.scrollTop());
    }

    function closeLightBox(lightboxPanel) {
        if (isDomElement) {
            moveDataContentDiv(lightboxPanel);
        }

        if (lightboxPanel) {
            lightboxPanel.destroy();
        }

        // todo: if the scrolling disabling is re-enabled above, turn this back on, also
        //    jQuery("body").css("overflow", "scroll");
    }

    function isLightBoxVisible(lightbox) {
        return is(lightbox) && is(lightbox.mask);
    }

    function is(what) {
        return what != undefined && what != null;
    }

    function moveDataContentDiv(lightboxPanel) {
        jQuery(lightboxPanel.dataContent).hide();
        jQuery(lightboxPanel.dataContent).appendTo("body");
    }

    function popSimpleLightbox(title, content, config) {
        fetchOrCreateLightboxContainer();
        return openLightbox("theLightboxContainer", "/util/lightbox", config, "theLightbox", {
            title: title,
            content: content
        });
    }

    function popLightbox(title, includePage, config) {
        fetchOrCreateLightboxContainer();
        return openLightbox("theLightboxContainer", "/util/lightbox", config, "theLightbox", {
            title: title,
            includePage: includePage
        });
    }

    function popLightboxIFrame(title, iframeConfig, lightboxConfig) {
        var content = '<div id="lightboxIframe"></div>';
        var lightbox = popSimpleLightbox(title, content, lightboxConfig);
        iframeConfig.id = "lightboxIframe";
        Infusion.Ajax.iFrameFill(iframeConfig);
        return lightbox;
    }

    function fetchOrCreateLightboxContainer() {
        var container = jQuery("#theLightboxContainer");
        if (container.length == 0) {
            container = jQuery("<div id='theLightboxContainer'></div>").appendTo(jQuery("body"));
        }
        return container;
    }

}, {css: ["/resources/util/css/lightbox.css"],
    js: ["/js/yui/yahoo-dom-event/yahoo-dom-event.js", "/js/yui/container/container-min.js"],
    loadInOrder: true });


// Non-namespaced functions
function centerWindow() {
    //If this is an IFrame we don't want to center the window...
    if (window.opener) {
        var left = (screen.width - document.body.clientWidth) / 2;
        var top = (screen.height - document.body.clientHeight) / 2;
        if (left < 645) window.moveTo(left, top - 50);
    }
}

function openAdminHW(url, height, width, windowName) {
    if (!windowName) {
        windowName = "admin";
    }


    var currentWindow = window;
    var window_depth = 1;


    while (currentWindow.opener && currentWindow.name != "selenium_main_app_window") {
        window_depth++;
        currentWindow = currentWindow.opener;
    }


    if (window_depth > 1) {
        windowName = "admin_level" + window_depth;
    }


    var winleft = (screen.width - width) / 2;
    var winUp = (screen.height - height) / 2;
    var winProp = 'width=' + width + ',height=' + height +
        ',left=' + winleft + ',top=' + winUp +
        ',scrollbars=yes,resizable=yes';

    try {
        var popper = window.open(url, windowName, winProp);
        try {
            popper.focus();
        } catch(error2) {
            alert("Error creating pop-up window.  Do you have pop-up blocker software running?");
        }
    } catch(error) {
        try {
            var myDate = new Date();
            var popper2 = window.open(url, windowName + "-" + myDate.getUTCFullYear()() + myDate.getUTCMonth() + myDate.getUTCDay() + myDate.getUTCHours() + myDate.getUTCMinutes() + myDate.getUTCSeconds(), winProp);
            popper2.focus();
        } catch(error2) {
            alert(error2.message);
        }
    }
}

function openAdmin(url, windowName) {
    openAdminHW(url, 450, 700, windowName);
}

function openAdminTall(url, windowName) {
    openAdminHW(url, 600, 575, windowName);
}

function openAdminH(url, height, windowName) {
    openAdminHW(url, height, 575, windowName);
}

function clearElement(elementName, label) {
    jQuery('#' + elementName).val(0);
    var textToDisplay = 'Choose ' + Infusion.Utils.getIndefiniteArticle(label);
    jQuery('#' + elementName + "_Name").val(textToDisplay);
}

function goToElement(elementName, managePage, label) {
    var gotoId = jQuery('#' + elementName).val();
    if (gotoId > 0) {
        if (confirm("You are leaving this page.  Any unsaved changes will be lost!\n\nDo you want to continue?")) {
            window.location = managePage + '?view=edit&ID=' + gotoId;
        }
    } else {
        alert('You must choose ' + Infusion.Utils.getIndefiniteArticle(label) + '!');
    }
}

function goToElementController(elementName, controllerPage, label){
    var gotoId = jQuery('#' + elementName).val();
    if (gotoId > 0) {
        if (confirm("You are leaving this page.  Any unsaved changes will be lost!\n\nDo you want to continue?")) {
            window.location = controllerPage + '?affiliateId=' + gotoId;
        }
    } else {
        alert('You must choose ' + Infusion.Utils.getIndefiniteArticle(label) + '!');
    }
}

function openElementPopUp(popUpPageUrl, elementName, formName, tableName, classPathName, returnCode) {
    var initialSearch = jQuery('#' + elementName + '_Name');
    var searchPopUpUrl = popUpPageUrl +
        '?table=' + tableName +
        '&dfld=' + elementName + '_Name' +
        '&idfld=' + elementName +
        '&formName=' + formName +
        '&Name_DATA=' + initialSearch.val();
    if (classPathName != null && classPathName != '') {
        searchPopUpUrl += '&classname=' + classPathName;
    }
    if (returnCode != null && returnCode != '') {
        searchPopUpUrl += '&returnCode=' + returnCode;
    }
    openAdminHW(searchPopUpUrl, 600, 775);
}

function activateSearch(popUpPageUrl, elementName, formName, returnCode) {
    jQuery('#' + elementName + '_Name').val('');
    openElementPopUp(popUpPageUrl, elementName, formName, null, null, returnCode);
}

    ;Infusion.scriptLoaded('/resources/popup/popup.js');
    


/* FILE: /resources/component/inapphelp/inapphelp.js */
Infusion("Component.Inapphelp", function() {
    var ns = Infusion.Component.Inapphelp;
    var feedbackLightbox;

    ns.searchBarOnFocusHandler = searchBarOnFocusHandler;
    ns.setWindowSize = setWindowSize;
    ns.articleClicked = articleClicked;
    ns.backToMenu = backToMenu;
    ns.resetContentDiv = resetContentDiv;
    ns.displayHelpSystemArticles = displayHelpSystemArticles;
    ns.renderArticle = renderArticle;
    ns.isAPopup = isAPopup;
    ns.openSubmitSupportCaseLightbox = openSubmitSupportCaseLightbox;
    ns.submitThumbsUp = submitThumbsUp;
    ns.submitThumbsDown = submitThumbsDown;
    ns.submitFeedback = submitFeedback;
    ns.closeFeedbackLightbox = closeFeedbackLightbox;
    ns.getPageCrumbId = getPageCrumbId;

    function getPageCrumbId() {
        var pageCrumbId = "noPageCrumb";
        if (parent.Infusion.Component.Context != undefined) {
            pageCrumbId = parent.Infusion.Component.Context.getId();
        }
        return pageCrumbId;
    }

    function searchBarOnFocusHandler() {
        jQuery("#iah-searchbox-input").focus(function() {
            if (jQuery(this).val() == "search for something...") {
                jQuery(this).val("");
                jQuery(this).css("color", "black");
                jQuery(this).unbind();
                jQuery(this).focus();
            }
        });
    }

    function setWindowSize(height, width) {
        jQuery("#inAppHelpContainer").height(height).width(width);
        jQuery("#iah-container").height(height - 40).width(width);
        jQuery("#iah-content").height(height - 50).width(width);
        jQuery("#iah-article-view").height(height - 60).width(width - 10);
    }

    function articleClicked(helpResultId, articleId, title) {
        var setArticleClickedAction = Infusion.Url.getViewUrl('helpSystem', 'setArticleClicked');
        jQuery.post(setArticleClickedAction,{
            helpResultIdString: helpResultId,
            articleId: articleId,
            title: title
        });
    }

    function backToMenu(helpSystemQueryRan) {
        jQuery('#iah-content').show();
        jQuery('#iah-article-view').hide();
        jQuery("#thumbs-up").removeClass("active");
        jQuery("#thumbs-down").removeClass("active");
        jQuery("#iah-article-rating").hide();
        jQuery('#iah-back-link').hide();
        jQuery.post(Infusion.Url.getViewUrl("helpSystem", "setViewingArticle"),
        {viewingArticle: false}
                );

        var parentPageTitle;
        var pageCrumbId;
        if (!helpSystemQueryRan) {
            if (Infusion.Component.Inapphelp.isAPopup()) {
                parentPageTitle = window.opener.document.title;
                pageCrumbId = window.opener.Infusion.Component.Context.getId();

                displayHelpSystemArticles("", pageCrumbId, "iah-related-articles");
            } else {
                parentPageTitle = jQuery('title').html();
                pageCrumbId = Infusion.Component.Context.getId();
                displayHelpSystemArticles("", pageCrumbId, "iah-related-articles");
            }
        }
    }

    function resetContentDiv() {
        jQuery('#iah-content').show();
        jQuery('#iah-article-view').hide();
        jQuery('#iah-back-link').hide();
    }

    function displayHelpSystemArticles(queryParam, pageCrumb, listId) {
        clearListResults(listId);
        jQuery("#iah-ask-question-container").hide();
        jQuery("#" + listId).parent().append("<img id='" + listId + "-spinner' src='/slices/ajax-spinner.gif' class='spinner-padding'/>");

        var helpSystemAction = '';
        var searchString = '';
        var postData;
        if(pageCrumb == '') {
            helpSystemAction = Infusion.Url.getJsonUrl('helpSystem', 'getArticleListBySearchQuery');
            postData = {searchString : queryParam};
        } else {
            helpSystemAction = Infusion.Url.getJsonUrl('helpSystem', 'getArticleListByPageCrumb');
            postData = {pageCrumb : pageCrumb, searchString : queryParam};
        }

        jQuery.getJSON(helpSystemAction,
                postData,
                function(data) {
                    clearListResults(listId); // in some rare cases the list may have content from a previous call
                    jQuery("#" + listId + "-spinner").remove();
                    var index = 0;
                    jQuery(data).each(function(key, object) {
                        if (index == 0) {
                            jQuery("#" + listId + "-view-all-link").html("");
                            jQuery("#" + listId + "-view-all-link").append('<a target="_blank" href="../previewOrderForm_files/'%20+%20object.viewAllUrl%20+%20'">View All (' + object.totalNumberOfArticles + ')</a>');
                        } else {
                            var html = "<li><a title=\"Article\" href=../previewOrderForm_files/\%22javascript:Infusion.Component.Inapphelp.renderArticle(%27%22 + object.articleId + "');\" " +
                                    "onclick=\"Infusion.Component.Inapphelp.articleClicked(\'" + object.helpResultId + "\',\'" + object.articleId + "\',\'" + object.title + "\');\">" + object.title + "</a></li>";
                            jQuery("#" + listId).append(html);
                        }
                        index++;
                    });
                    if (data.size() <= 1) {
                        jQuery("#" + listId).append("<li class='no-results-icon'><em>No results, try another search term.</em></li>");
                    }
//                    jQuery(".view-all-list-link").show();
                }
        );
    }

    function renderArticle(articleId, cached, scrollPosition, isAVideo) {
        cached = cached || false;
        isAVideo = isAVideo || false;
        scrollPosition = scrollPosition || 0;

        var servletUrl;
        if (cached) {
            servletUrl = Infusion.Url.getJsonUrl("helpSystem", "getCachedArticleContent");
        } else {
            servletUrl = Infusion.Url.getJsonUrl("helpSystem", "renderArticle");
            scrollPosition = 0;
        }
        if (!isAVideo) {
            jQuery("#iah-back-link").show();
        }
        clearArticleContent();
        jQuery("#iah-content").hide();
        jQuery("#iah-article-view-spinner").show();
        jQuery("#iah-article-view").show();

        jQuery.getJSON(servletUrl,
                {articleId: articleId},
                function(data) {
                    jQuery("#iah-article-view-spinner").hide();
                    jQuery("#iah-article-title").html(data.title);
                    jQuery("#iah-article-content").html(data.content);
                    if (!Infusion.Component.Inapphelp.isAPopup()) {
                        jQuery("#iah-article-view").scrollTop(scrollPosition);
                    } else {
                        jQuery(window).scrollTop(scrollPosition);
                    }
                    if (isAVideo) {
                        getVideoSize();
                    }
                    jQuery("#iah-article-rating").show();
                });
    }

    function isAPopup() {
        var popup = false;
        if (!jQuery("#iah-header").length > 0) {
            popup = true;
        }
        return popup;
    }

    function openSubmitSupportCaseLightbox(fromNav) {
        var submitSupportCaseLightbox;
        // Check if in popped out IAH, if so, open as a pop up window
        if (Infusion.Component.Inapphelp.isAPopup() && !fromNav) {
            var windowName = "question";

            var width = "430px";
            var height = "550px";

            var windowUrl = Infusion.Url.getViewUrl('helpSystem', 'submitSupportCaseLightbox');
            var currentWindow = window;
            var window_depth = 1;

            while(currentWindow.opener){
                window_depth++;
                currentWindow = currentWindow.opener;
            }

            if(window_depth > 1){
                windowName = "admin_level" + window_depth;
            }

            var winleft = (screen.width - width) / 2;
            var winUp = (screen.height - height) / 2;
            var winProp = 'width=' + width + ' ,height=' + height + ',left='
                          + winleft + ',top=' + winUp +
                          ',scrollbars=yes, resizable=yes';

            var feedbackPopup = window.open(windowUrl, windowName, winProp);
            feedbackPopup.focus();
        } else {
            var iframeConfig = {
                url: Infusion.Url.getViewUrl('helpSystem', 'submitSupportCaseLightbox'),
                width: "420px",
                height: "550px",
                scrolling: false
            };
            var lightboxConfig = {width: "430", height: "670", startcentered: true};
            feedbackLightbox = Infusion.Popup.popLightboxIFrame('Submit a Support Case', iframeConfig, lightboxConfig);
        }
        return submitSupportCaseLightbox;
    }

    function submitThumbsUp() {
        var setArticleRatingAction = Infusion.Url.getViewUrl('helpSystem', 'setArticleRating');
        jQuery.post(setArticleRatingAction,{
            helpResultRating: 'ThumbsUp'
        });
        jQuery("#thumbs-up").addClass("active");
        jQuery("#thumbs-down").removeClass("active");
    }

    function submitThumbsDown() {
        var setArticleRatingAction = Infusion.Url.getViewUrl('helpSystem', 'setArticleRating');
        jQuery.post(setArticleRatingAction,{
            helpResultRating: 'ThumbsDown'
        });
        jQuery("#thumbs-down").addClass("active");
        jQuery("#thumbs-up").removeClass("active");
        if (!Infusion.Component.Inapphelp.isAPopup()) {
            var iframeConfig = {
                url: "/InAppHelp/submitArticleFeedback.jsp",
                width: "365px",
                height: "180px",
                scrolling: false
            };
            var lightboxConfig = {width: "375px", height: "255px"};
            feedbackLightbox = Infusion.Popup.popLightboxIFrame('Feedback',iframeConfig, lightboxConfig);
        } else {
            var windowName = "feedback";

            var width = "375px";
            var height = "195px";

            var windowUrl = "/InAppHelp/submitArticleFeedback.jsp";
            var currentWindow = window;
            var window_depth = 1;

            while(currentWindow.opener){
                window_depth++;
                currentWindow = currentWindow.opener;
            }

            if(window_depth > 1){
                windowName = "admin_level" + window_depth;
            }

            var winleft = (screen.width - width) / 2;
            var winUp = (screen.height - height) / 2;
            var winProp = 'width=' + width + ' ,height=' + height + ',left='
                          + winleft + ',top=' + winUp +
                          ',scrollbars=yes, resizable=yes';

            var feedbackPopup = window.open(windowUrl, windowName, winProp);
            feedbackPopup.focus();
        }
    }


    function submitFeedback(feedback) {
        var setArticleFeedbackAction = Infusion.Url.getViewUrl('helpSystem', 'setArticleFeedback');
        jQuery.post(setArticleFeedbackAction,{
            helpResultFeedback: feedback
        });
    }

    function closeFeedbackLightbox() {
        Infusion.Popup.closeLightBox(feedbackLightbox);
    }

    function getVideoSize() {
        var width = 0;
        var height = 0;

        var iframeSize = jQuery('#iah-article-content>p>iframe').size();
        var objectSize = jQuery('#iah-article-content>p>object').size();
        if (iframeSize > 0) {
            width = 700;
            height = 600;
            jQuery('#iah-article-content>p>iframe').attr('height', '100%');
        } else if (objectSize > 0) {
            width = parseInt(jQuery('#iah-article-content>p>object').attr('width')) + parseInt(40);
            height = parseInt(jQuery('#iah-article-content>p>object').attr('height')) + parseInt(200);
        }
        if (width > 0 && height > 0) {
            window.resizeTo(width, height);
        }
    }

    function clearArticleContent() {
        jQuery("#iah-article-content").html("");
        jQuery("#iah-article-title").html("");
    }

    function clearListResults(listId) {
        jQuery("#" + listId + " li").each(function() {
            jQuery(this).remove();
        });
    }

});

    ;Infusion.scriptLoaded('/resources/component/inapphelp/inapphelp.js');
    


/* FILE: /js/jquery/plugins/dropshadow/jquery.dropshadow.js */
/*
	VERSION: Drop Shadow jQuery Plugin 1.6  12-13-2007

	REQUIRES: jquery.js (1.2.6 or later)

	SYNTAX: $(selector).dropShadow(options);  // Creates new drop shadows
					$(selector).redrawShadow();       // Redraws shadows on elements
					$(selector).removeShadow();       // Removes shadows from elements
					$(selector).shadowId();           // Returns an existing shadow's ID

	OPTIONS:

		left    : integer (default = 4)
		top     : integer (default = 4)
		blur    : integer (default = 2)
		opacity : decimal (default = 0.5)
		color   : string (default = "black")
		swap    : boolean (default = false)

	The left and top parameters specify the distance and direction, in	pixels, to
	offset the shadow. Zero values position the shadow directly behind the element.
	Positive values shift the shadow to the right and down, while negative values
	shift the shadow to the left and up.

	The blur parameter specifies the spread, or dispersion, of the shadow. Zero
	produces a sharp shadow, one or two produces a normal shadow, and	three or four
	produces a softer shadow. Higher values increase the processing load.

	The opacity parameter	should be a decimal value, usually less than one. You can
	use a value	higher than one in special situations, e.g. with extreme blurring.

	Color is specified in the usual manner, with a color name or hex value. The
	color parameter	does not apply with transparent images.

	The swap parameter reverses the stacking order of the original and the shadow.
	This can be used for special effects, like an embossed or engraved look.

	EXPLANATION:

	This jQuery plug-in adds soft drop shadows behind page elements. It is only
	intended for adding a few drop shadows to mostly stationary objects, like a
	page heading, a photo, or content containers.

	The shadows it creates are not bound to the original elements, so they won't
	move or change size automatically if the original elements change. A window
	resize event listener is assigned, which should re-align the shadows in many
	cases, but if the elements otherwise move or resize you will have to handle
	those events manually. Shadows can be redrawn with the redrawShadow() method
	or removed with the removeShadow() method. The redrawShadow() method uses the
	same options used to create the original shadow. If you want to change the
	options, you should remove the shadow first and then create a new shadow.

	The dropShadow method returns a jQuery collection of the new shadow(s). If
	further manipulation is required, you can store it in a variable like this:

		var myShadow = $("#myElement").dropShadow();

	You can also read the ID of the shadow from the original element at a later
	time. To get a shadow's ID, either read the shadowId attribute of the
	original element or call the shadowId() method. For example:

		var myShadowId = $("#myElement").attr("shadowId");  or
		var myShadowId = $("#myElement").shadowId();

	If the original element does not already have an ID assigned, a random ID will
	be generated for the shadow. However, if the original does have an ID, the
	shadow's ID will be the original ID and "_dropShadow". For example, if the
	element's ID is "myElement", the shadow's ID would be "myElement_dropShadow".

	If you have a long piece of text and the user resizes the	window so that the
	text wraps or unwraps, the shape of the text changes and the words are no
	longer in the same positions. In that case, you can either preset the height
	and width, so that it becomes a fixed box, or you can shadow each word
	separately, like this:

		<h1><span>Your</span> <span>Page</span> <span>Title</span></h1>

		$("h1 span").dropShadow();

	The dropShadow method attempts to determine whether the selected elements have
	transparent backgrounds. If you want to shadow the content inside an element,
	like text or a transparent image, it must not have a background-color or
	background-image style. If the element has a solid background it will create a
	rectangular	shadow around the outside box.

	The shadow elements are positioned absolutely one layer below the original
	element, which is positioned relatively (unless it's already absolute).

	*** All shadows have the "dropShadow" class, for selecting with CSS or jQuery.

	ISSUES:

		1)	Limited styling of shadowed elements by ID. Because IDs must be unique,
				and the shadows have their own ID, styles applied by ID won't transfer
				to the shadows. Instead, style elements by class or use inline styles.
		2)	Sometimes shadows don't align properly. Elements may need to be wrapped
				in container elements, margins or floats changed, etc. or you may just
				have to tweak the left and top offsets to get them to align. For example,
				with draggable objects, you have to wrap them inside two divs. Make the
				outer div draggable and set the inner div's position to relative. Then
				you can create a shadow on the element inside the inner div.
		3)	If the user changes font sizes it will throw the shadows off. Browsers
				do not expose an event for font size changes. The only known way to
				detect a user font size change is to embed an invisible text element and
				then continuously poll for changes in size.
		4)	Safari support is shaky, and may require even more tweaks/wrappers, etc.

		The bottom line is that this is a gimick effect, not PFM, and if you push it
		too hard or expect it to work in every possible situation on every browser,
		you will be disappointed. Use it sparingly, and don't use it for anything
		critical. Otherwise, have fun with it!

	AUTHOR: Larry Stevens (McLars@eyebulb.com) This work is in the public domain,
					and it is not supported in any way. Use it at your own risk.
*/


(function($){

	var dropShadowZindex = 1;  //z-index counter

	$.fn.dropShadow = function(options)
	{
		// Default options
		var opt = $.extend({
			left: 4,
			top: 4,
			blur: 2,
			opacity: .5,
			color: "black",
			swap: false
			}, options);
		var jShadows = $([]);  //empty jQuery collection

		// Loop through original elements
		this.not(".dropShadow").each(function()
		{
			var jthis = $(this);
			var shadows = [];
			var blur = (opt.blur <= 0) ? 0 : opt.blur;
			var opacity = (blur == 0) ? opt.opacity : opt.opacity / (blur * 8);
			var zOriginal = (opt.swap) ? dropShadowZindex : dropShadowZindex + 1;
			var zShadow = (opt.swap) ? dropShadowZindex + 1 : dropShadowZindex;

			// Create ID for shadow
			var shadowId;
			if (this.id) {
				shadowId = this.id + "_dropShadow";
			}
			else {
				shadowId = "ds" + (1 + Math.floor(9999 * Math.random()));
			}

			// Modify original element
			$.data(this, "shadowId", shadowId); //store id in expando
			$.data(this, "shadowOptions", options); //store options in expando
			jthis
				.attr("shadowId", shadowId)
				.css("zIndex", zOriginal);
			if (jthis.css("position") != "absolute") {
				jthis.css({
					position: "relative",
					zoom: 1 //for IE layout
				});
			}

			// Create first shadow layer
			bgColor = jthis.css("backgroundColor");
			if (bgColor == "rgba(0, 0, 0, 0)") bgColor = "transparent";  //Safari
			if (bgColor != "transparent" || jthis.css("backgroundImage") != "none"
					|| this.nodeName == "SELECT"
					|| this.nodeName == "INPUT"
					|| this.nodeName == "TEXTAREA") {
				shadows[0] = $("<div></div>")
					.css("background", opt.color);
			}
			else {
				shadows[0] = jthis
					.clone()
					.removeAttr("id")
					.removeAttr("name")
					.removeAttr("shadowId")
					.css("color", opt.color);
			}
			shadows[0]
				.addClass("dropShadow")
				.css({
					height: jthis.outerHeight(),
					left: blur,
					opacity: opacity,
					position: "absolute",
					top: blur,
					width: jthis.outerWidth(),
					zIndex: zShadow
				});

            /*
               Vivin: Made a change. If the parent element has rounded borders, then we need to add that to the shadow
               also
             */

            var corners = ["topleft", "topright", "bottomleft", "bottomright"];

            for(var cidx = 0; cidx < corners.length; cidx++) {
                if(jthis.css("-moz-border-radius-" + corners[cidx]) != "") {                    
                    shadows[0].css("-moz-border-radius-" + corners[cidx], jthis.css("-moz-border-radius-" + corners[cidx]));
                }

                if(jthis.css("-webkit-border-radius-" + corners[cidx]) != "") {
                    shadows[0].css("-webkit-border-radius-" + corners[cidx], jthis.css("-webkit-border-radius-") + corners[cidx]);
                }
            }

			// Create other shadow layers
			var layers = (8 * blur) + 1;
			for (i = 1; i < layers; i++) {
				shadows[i] = shadows[0].clone();
			}

			// Position layers
			var i = 1;
			var j = blur;
			while (j > 0) {
				shadows[i].css({left: j * 2, top: 0});           //top
				shadows[i + 1].css({left: j * 4, top: j * 2});   //right
				shadows[i + 2].css({left: j * 2, top: j * 4});   //bottom
				shadows[i + 3].css({left: 0, top: j * 2});       //left
				shadows[i + 4].css({left: j * 3, top: j});       //top-right
				shadows[i + 5].css({left: j * 3, top: j * 3});   //bottom-right
				shadows[i + 6].css({left: j, top: j * 3});       //bottom-left
				shadows[i + 7].css({left: j, top: j});           //top-left
				i += 8;
				j--;
			}

			// Create container
			var divShadow = $("<div></div>")
				.attr("id", shadowId)
				.addClass("dropShadow")
				.css({
					left: jthis.position().left + opt.left - blur,
					marginTop: jthis.css("marginTop"),
					marginRight: jthis.css("marginRight"),
					marginBottom: jthis.css("marginBottom"),
					marginLeft: jthis.css("marginLeft"),
					position: "absolute",
					top: jthis.position().top + opt.top - blur,
					zIndex: zShadow
				});

			// Add layers to container
			for (i = 0; i < layers; i++) {
				divShadow.append(shadows[i]);
			}

			// Add container to DOM
			jthis.after(divShadow);

			// Add shadow to return set
			jShadows = jShadows.add(divShadow);

			// Re-align shadow on window resize
			$(window).resize(function()
			{
				try {
					divShadow.css({
						left: jthis.position().left + opt.left - blur,
						top: jthis.position().top + opt.top - blur
					});
				}
				catch(e){}
			});

			// Increment z-index counter
			dropShadowZindex += 2;

		});  //end each

		return this.pushStack(jShadows);
	};


	$.fn.redrawShadow = function()
	{
		// Remove existing shadows
		this.removeShadow();

		// Draw new shadows
		return this.each(function()
		{
			var shadowOptions = $.data(this, "shadowOptions");
			$(this).dropShadow(shadowOptions);
		});
	};


	$.fn.removeShadow = function()
	{
		return this.each(function()
		{
			var shadowId = $(this).shadowId();
			$("div#" + shadowId).remove();
		});
	};


	$.fn.shadowId = function()
	{
		return $.data(this[0], "shadowId");
	};


	$(function()
	{
		// Suppress printing of shadows
		var noPrint = "<style type='text/css' media='print'>";
		noPrint += ".dropShadow{visibility:hidden;}</style>";
		$("head").append(noPrint);
	});

})(jQuery);
    ;Infusion.scriptLoaded('/js/jquery/plugins/dropshadow/jquery.dropshadow.js');
    


/* FILE: /js/jquery/plugins/tooltip/jquery.tooltip.js */
/*

 Clickable-Tooltp jQuery Plugin
 Author: Vivin Suresh Paliath <vivinp@infusionsoft.com>
 Date: 5th August, 2009

*/

(function(jQuery) {
    var globalOptions = {};
    var internetExplorerFirstClick = {}; //Need to handle special cases for that horrible abomination
    var isInternetExplorer = /*@cc_on!@*/false; //Flag to handle the horrible abomination

    var positionReverseMap = {
        top: "bottom",
        bottom: "top",
        right: "teft",
        left: "right"
    };

    var shadowOffsetMap = {
        top: -1,
        left: -1,
        bottom: 1,
        right: 1
    };

    var imagePositionMarginMap = {
        topright: "bottom",
        topmiddle: "bottom",
        topleft: "bottom",
        lefttop: "right",
        leftmiddle: "right",
        leftbottom: "right",
        bottomleft: "top",
        bottommiddle: "top",
        bottomright: "top",
        rightbottom: "left",
        rightmiddle: "left",
        righttop: "left"
    };

    var imagePositionCalculationFunctionMap = {
        topright: calculateImageTopRightPosition,
        topmiddle: calculateImageTopMiddlePosition,
        topleft: calculateImageTopLeftPosition,
        lefttop: calculateImageLeftTopPosition,
        leftmiddle: calculateImageLeftMiddlePosition,
        leftbottom: calculateImageLeftBottomPosition,
        bottomleft: calculateImageBottomLeftPosition,
        bottommiddle: calculateImageBottomMiddlePosition,
        bottomright: calculateImageBottomRightPosition,
        rightbottom: calculateImageRightBottomPosition,
        rightmiddle: calculateImageRightMiddlePosition,
        righttop: calculateImageRightTopPosition
    };

    var tooltipPositionCalculationFunctionMap = {
        top: calculateTooltipTopPosition,
        left: calculateTooltipLeftPosition,
        bottom: calculateTooltipBottomPosition,
        right: calculateTooltipRightPosition
    };

    var pointImagePositionCalculationFunctionMap = {
        top: calculatePointImageTopPosition,
        left: calculatePointImageLeftPosition,
        bottom: calculatePointImageBottomPosition,
        right: calculatePointImageRightPosition
    };

    jQuery.fn.tooltip = function(opts) {
        var o = jQuery.extend({}, jQuery.fn.tooltip.defaults, opts);

        return this.each(function() {
            var $this = jQuery(this);
            globalOptions[$this.attr("id")] = jQuery.meta ? jQuery.extend({}, o, $this.data()) : o;

            internetExplorerFirstClick[$this.attr("id")] = true;

            var $tooltipImage = createTooltipImage($this);

            //Internet Explorer is stupid and loses all bound events when you do append, UNLESS you do clone(true).
            //This is a limitation of the IE DOM.

            if(isInternetExplorer) {
                jQuery("body").append($tooltipImage.clone(true));
            }

            else {
                jQuery("body").append($tooltipImage);
            }


            var tooltip = createTooltip($this, $tooltipImage);


            if(isInternetExplorer) {
                /*
                Why the .hide()? It's because internet explorer is a stupid piece of crap. Even though the tooltip is
                hidden, cloning it and appending it to the dom causes it to be somehow unhidden... or something. It's
                just IE's stupid retarded behavior (as usual). Also, in the handleInternetExplorer function, we have to
                explicitly show the tooltipDiv first. Otherwise positions aren't calculated properly
                 */

                jQuery("body").append(tooltip.$tooltipDiv.hide().clone(true));
                jQuery("body").append(tooltip.$pointImage.clone(true));
            }

            else {
                jQuery("body").append(tooltip.$tooltipDiv);
                jQuery("body").append(tooltip.$pointImage);
            }
        });
    };

    jQuery.fn.tooltip.defaults = {
        rootPath: "/js/jquery/plugins",
        skin: "default",
        imageType: "question",
        imagePosition: "rightmiddle",
        imageSpacing: 5,
        tooltipPosition: "right",
        tooltipSpacing: 0,
        backgroundColor: "#f7fbfe",
        borderColor: "#c8e2ec",
        width: 250,
        shadow: true,
        fade: true,
        includeCloseButton: true,
        text: "This is a tooltip with some default text! Monkeys are funny!!"
    };

    function createTooltipImage($this) {
        var options = globalOptions[$this.attr("id")];
        var $tooltipImage = jQuery("<img />").attr("id", "tooltipImage_" + $this.attr("id"))
                                             .attr("src", options.rootPath + "/tooltip/skins/" + options.skin + "/images/tooltip-" + options.imageType + ".png")
                                             .css("margin-" + imagePositionMarginMap[options.imagePosition], options.imageSpacing + "px")
                                             .addClass("tooltip-" + options.skin + "-image")
                                             .load(function() {
            var _$this = jQuery(this);
            var calculatedPosition = imagePositionCalculationFunctionMap[options.imagePosition]($this, _$this);
            _$this.css("top", calculatedPosition.top)
                  .css("left", calculatedPosition.left);
        });

        $tooltipImage.click(function() {
            toggleTooltipDiv($this);
        });

        return $tooltipImage;
    };

    function createTooltip($this, $tooltipImage) {
        var options = globalOptions[$this.attr("id")];
        var $tooltipDiv = jQuery("<div></div>").attr("id", "tooltip_" + $this.attr("id"))
                                               .css({
                                                   backgroundColor: options.backgroundColor,
                                                   border: "1px solid " + options.borderColor,
                                                   width: options.width + "px"
                                                })
                                               .addClass("tooltip-" + options.skin)
                                               .text(options.text)
                                               .css("margin-" + positionReverseMap[options.tooltipPosition], options.tooltipSpacing + "px");

        var $pointImage = jQuery("<img />").attr("id", "tooltipPointImage_" + $this.attr("id"))
                                           .attr("src", options.rootPath + "/tooltip/skins/" + options.skin + "/images/tooltip-point-" + options.tooltipPosition + ".png")
                                           .css("margin-" + positionReverseMap[options.tooltipPosition], options.tooltipSpacing + "px")
                                           .addClass("tooltip-point-" + options.skin + "-image")
                                           .load(function() {
            var _$this = jQuery(this);
            var calculatedPosition = tooltipPositionCalculationFunctionMap[options.tooltipPosition]($tooltipDiv, _$this, $tooltipImage);

            $tooltipDiv.css("top", calculatedPosition.top)
                       .css("left", calculatedPosition.left);

            calculatedPosition = pointImagePositionCalculationFunctionMap[options.tooltipPosition]($tooltipDiv, _$this);

            _$this.css("top", calculatedPosition.top)
                  .css("left", calculatedPosition.left);

            if(jQuery.fn.dropShadow && options.shadow) {
                $tooltipDiv.dropShadow({
                    top: 2 * shadowOffsetMap[options.tooltipPosition],
                    left: 2 * shadowOffsetMap[options.tooltipPosition],
                    blur: 2
                }).hide();
                //Adding a dropshadow causes the z-index of the parent element to change. We need to make sure that the
                //point image has the same z-index as the tooltip
                _$this.css("z-index", $tooltipDiv.css("z-index"));
            }

            $tooltipDiv.hide();
            _$this.hide();
        });

        if(options.includeCloseButton) {
            var $textDiv = jQuery("<div></div>").html(options.text);

            var $closeImage = jQuery("<img />").attr("id", "tooltipCloseImage_" + $this.attr("id"))
                                               .attr("src", options.rootPath + "/tooltip/skins/" + options.skin + "/images/tooltip-close.png")
                                               .addClass("tooltip-" + options.skin + "-close-image")
                                               .load(function() {
                var _$this = jQuery(this);
                _$this.css("top", 7 + "px")
                     .css("left", (getRightCoordinate($tooltipDiv) - _$this.width() - 15) + "px");
            }).click(function() {
                toggleTooltipDiv($this);
            });

            $tooltipDiv.text("");
            $tooltipDiv.append($textDiv);
            $tooltipDiv.append($closeImage);
        }

        return {
            $tooltipDiv: $tooltipDiv,
            $pointImage: $pointImage
        };
    };

    function toggleTooltipDiv($this) {
        var options = globalOptions[$this.attr("id")];
        var $tooltipDiv = jQuery("#tooltip_" + $this.attr("id"));
        var $pointImage = jQuery("#tooltipPointImage_" + $this.attr("id"));

        //We need to handle Internet Explorer here. It won't calculate the positions correctly. This whole problem
        //exists because of IE's inability to properly handle onload events. So we have to recalculate the position
        //of the tooltip when we first draw it.

        if(isInternetExplorer && internetExplorerFirstClick[$this.attr("id")]) {
            handleInternetExplorer($this);
        }

        if(options.fade) {
            if($tooltipDiv.is(":hidden")) {
                $tooltipDiv.fadeIn("normal");

                if(jQuery.fn.dropShadow && options.shadow) {
                    //The reason we have two fadeIn calls is that fadeIns work on the parent dropshadow div, but
                    //fadeOuts only work on the the child divs of the parent dropshadow div. The converse also holds
                    //true. Hence we have to have two calls

                    jQuery("#" + $tooltipDiv.shadowId()).fadeIn("slow");
                    jQuery("#" + $tooltipDiv.shadowId() + " div").fadeIn("slow");
                }

                $pointImage.fadeIn("normal");
            }

            else {
                $tooltipDiv.fadeOut("normal");

                if(jQuery.fn.dropShadow && options.shadow) {
                    jQuery("#" + $tooltipDiv.shadowId()).fadeOut("fast");
                    jQuery("#" + $tooltipDiv.shadowId() + " div").fadeOut("fast");
                }

                $pointImage.fadeOut("normal");
            }
        }

        else {
            $tooltipDiv.toggle();
            if(jQuery.fn.dropShadow && options.shadow) {
                if(jQuery("#" + $tooltipDiv.shadowId()).is(":hidden")) {
                    jQuery("#" + $tooltipDiv.shadowId()).show();
                    jQuery("#" + $tooltipDiv.shadowId() + " div").show();
                }

                else {
                    jQuery("#" + $tooltipDiv.shadowId()).hide();
                    jQuery("#" + $tooltipDiv.shadowId() + " div").hide();                    
                }
            }
            $pointImage.toggle();
        }
    };
    
    function handleInternetExplorer($this) {
        var options = globalOptions[$this.attr("id")];
        var $tooltipDiv = jQuery("#tooltip_" + $this.attr("id"));
        var $tooltipImage = jQuery("#tooltipImage_" + $this.attr("id"));
        var $pointImage = jQuery("#tooltipPointImage_" + $this.attr("id"));
        var $closeImage = jQuery("#tooltipCloseImage_" + $this.attr("id"));

        /*
        Explicitly show the tooltipDiv before calculating positions, because IE is stupid.
         */
        $tooltipDiv.show();

        var calculatedPosition = tooltipPositionCalculationFunctionMap[options.tooltipPosition]($tooltipDiv, $pointImage, $tooltipImage);

        $tooltipDiv.css("top", calculatedPosition.top)
                   .css("left", calculatedPosition.left);


        calculatedPosition = pointImagePositionCalculationFunctionMap[options.tooltipPosition]($tooltipDiv, $pointImage);

        $pointImage.css("top", calculatedPosition.top)
              .css("left", calculatedPosition.left);

        if(jQuery.fn.dropShadow && options.shadow) {
            $tooltipDiv.dropShadow({
                top: 2 * shadowOffsetMap[options.tooltipPosition],
                left: 2 * shadowOffsetMap[options.tooltipPosition],
                blur: 2
            }).hide();
            //Adding a dropshadow causes the z-index of the parent element to change. We need to make sure that the
            //point image has the same z-index as the tooltip
            $pointImage.css("z-index", $tooltipDiv.css("z-index"));
        }

        $tooltipDiv.hide();
        $pointImage.hide();

        $closeImage.css("top", 7 + "px")
                   .css("left", (getRightCoordinate($tooltipDiv) - $closeImage.width() - 15) + "px");

        internetExplorerFirstClick[$this.attr("id")] = false;
    };

    /*

     The following positioning-functions will make more sense if you look at the this lovely ASCII art:

        TL  TM  TR
     LT +--------+ RT
        |        |
     LM |        | RM
        |        |
     LB +--------+ RB
        BL  BM  BR

     The two-letter combinations specify the positions of the clickable tooltip-image relative the the element that we're
     attacking the tooltip to (the box).
     */

    function calculateImageTopRightPosition($this, $tooltipImage) {
        return {
            top: getTop_TopCoordinate($this, $tooltipImage),
            left: getRelativeRight_LeftCoordinate($this, $tooltipImage)
        };
    };

    function calculateImageTopMiddlePosition($this, $tooltipImage) {
        return {
            top: getTop_TopCoordinate($this, $tooltipImage),
            left: getRelativeMiddle_LeftCoordinate($this, $tooltipImage)
        };
    };

    function calculateImageTopLeftPosition($this, $tooltipImage) {
        return {
            top: getTop_TopCoordinate($this, $tooltipImage),
            left: getRelativeLeft_LeftCoordinate($this, $tooltipImage)
        };
    };

    function calculateImageLeftTopPosition($this, $tooltipImage) {
        return {
            top: getRelativeTop_TopCoordinate($this, $tooltipImage),
            left: getLeft_LeftCoordinate($this, $tooltipImage)
        };
    };

    function calculateImageLeftMiddlePosition($this, $tooltipImage) {
        return {
            top: getRelativeMiddle_TopCoordinate($this, $tooltipImage),
            left: getLeft_LeftCoordinate($this, $tooltipImage)
        };
    };

    function calculateImageLeftBottomPosition($this, $tooltipImage) {
        return {
            top: getRelativeBottom_TopCoordinate($this, $tooltipImage),
            left: getLeft_LeftCoordinate($this, $tooltipImage)
        };
    };

    function calculateImageBottomLeftPosition($this, $tooltipImage) {
        return {
            top: getBottom_TopCoordinate($this, $tooltipImage),
            left: getRelativeLeft_LeftCoordinate($this, $tooltipImage)
        };
    };

    function calculateImageBottomMiddlePosition($this, $tooltipImage) {
        return {
            top: getBottom_TopCoordinate($this, $tooltipImage),
            left: getRelativeMiddle_LeftCoordinate($this, $tooltipImage)
        };
    };

    function calculateImageBottomRightPosition($this, $tooltipImage) {
        return {
            top: getBottom_TopCoordinate($this, $tooltipImage),
            left: getRelativeRight_LeftCoordinate($this, $tooltipImage)
        };
    };

    function calculateImageRightBottomPosition($this, $tooltipImage) {
        return {
            top: getRelativeBottom_TopCoordinate($this, $tooltipImage),
            left: getRight_LeftCoordinate($this, $tooltipImage)
        };
    };

    function calculateImageRightMiddlePosition($this, $tooltipImage) {
        return {
            top: getRelativeMiddle_TopCoordinate($this, $tooltipImage),
            left: getRight_LeftCoordinate($this, $tooltipImage)
        };
    };

    function calculateImageRightTopPosition($this, $tooltipImage) {
        return {
            top: getRelativeTop_TopCoordinate($this, $tooltipImage),
            left: getRight_LeftCoordinate($this, $tooltipImage)
        };
    };

    /*
      Helper functions that calculate coordinates of the clickable image relative to the element that we're attaching
      the tooltip to.

      The following functions calculate the LEFT coordinate for the TL, TM, TR, BL, BM, and BR image positions */

    function getRelativeLeft_LeftCoordinate($this, $tooltipImage) {
        return $this.position().left;
    };

    function getRelativeMiddle_LeftCoordinate($this, $tooltipImage) {
        return $this.position().left + (($this.outerWidth() - $tooltipImage.width()) / 2);
    };

    function getRelativeRight_LeftCoordinate($this, $tooltipImage) {
        return getRightCoordinate($this) - $tooltipImage.width();
    };

    /* The following functions calculate the TOP coordinate for the LT, LM, LB, RT, RM, and RB image positions */

    function getRelativeTop_TopCoordinate($this, $tooltipImage) {
        return $this.position().top;
    };

    function getRelativeMiddle_TopCoordinate($this, $tooltipImage) {
        return $this.position().top + (($this.outerHeight(true) - $tooltipImage.height()) / 2);
    };

    function getRelativeBottom_TopCoordinate($this, $tooltipImage) {
        return $this.position().top + ($this.outerHeight(true) - $tooltipImage.height());
    };

    /* The following function calculate the TOP position for the TL, TM, and TR image positions */

    function getTop_TopCoordinate($this, $tooltipImage) {
        return $this.position().top - ($tooltipImage.height() + globalOptions[$this.attr("id")].imageSpacing);
    };

    /* The following function calculates the LEFT position for the LT, LM, and LB image positions */

    function getLeft_LeftCoordinate($this, $tooltipImage) {
        return $this.position().left - ($tooltipImage.width() + globalOptions[$this.attr("id")].imageSpacing);
    };

    /* The following function calculates the TOP position for the BL, BM, and BR image positions */

    function getBottom_TopCoordinate($this, $tooltipImage) {
        return $this.position().top + $this.outerHeight() + globalOptions[$this.attr("id")].imageSpacing;
    };

    /* The following function calculates the LEFT position for the RM, RM, and RT image positions */

    function getRight_LeftCoordinate($this, $tooltipImage) {
        return getRightCoordinate($this) + globalOptions[$this.attr("id")].imageSpacing;
    };

    /*
     Functions that calculate the position of the tooltip


         +-------------+
         |             |
     ?  <              |
         |             |
         +-------------+

     The box with the angle bracket is the tooltip
    */

    function calculateTooltipTopPosition($tooltip, $pointImage, $tooltipImage) {
        return {
            top: $tooltipImage.position().top - ($tooltip.outerHeight() + $pointImage.height() + globalOptions[$tooltip.attr("id").replace(/tooltip_/, "")].tooltipSpacing),
            left: $tooltipImage.position().left - (($tooltip.outerWidth() - $tooltipImage.outerWidth(true)) / 2)
        };
    };

    function calculateTooltipLeftPosition($tooltip, $pointImage, $tooltipImage) {
        return {
            top: $tooltipImage.position().top - (($tooltip.outerHeight() - $tooltipImage.outerHeight(true)) / 2),
            left: $tooltipImage.position().left - $tooltip.outerWidth() - globalOptions[$tooltip.attr("id").replace(/tooltip_/, "")].tooltipSpacing
        };
    };

    function calculateTooltipBottomPosition($tooltip, $pointImage, $tooltipImage) {
        return {
            top: $tooltipImage.position().top + $tooltipImage.outerHeight(true) + globalOptions[$tooltip.attr("id").replace(/tooltip_/, "")].tooltipSpacing,
            left: $tooltipImage.position().left - (($tooltip.outerWidth() - $tooltipImage.outerWidth(true)) / 2)
        };
    };

    function calculateTooltipRightPosition($tooltip, $pointImage, $tooltipImage) {
        return {
            top: $tooltipImage.position().top - (($tooltip.outerHeight() - $tooltipImage.outerHeight(true)) / 2),
            left: $tooltipImage.position().left + $tooltipImage.outerWidth(true) + globalOptions[$tooltip.attr("id").replace(/tooltip_/, "")].tooltipSpacing + $pointImage.width()
        };
    };

    /*
     Functions that calculate the position of the tooltip "point" image

         +-------------+
         |             |
     ?  <              |
         |             |
         +-------------+

     The angle bracket is the "point" image.

    */

    function calculatePointImageTopPosition($tooltip, $pointImage) {
        return {
            top: getBottomCoordinate($tooltip) - 1,
            left: ($tooltip.position().left + (($tooltip.outerWidth() - $pointImage.width() + globalOptions[$tooltip.attr("id").replace(/tooltip_/, "")].imageSpacing) / 2))
        };
    };

    function calculatePointImageLeftPosition($tooltip, $pointImage) {
        return {
            top: $tooltip.position().top + (($tooltip.outerHeight() - $pointImage.height()) / 2),
            left: getRightCoordinate($tooltip) - 1
        };
    };

    function calculatePointImageBottomPosition($tooltip, $pointImage) {
        return {
            top: ($tooltip.position().top - $pointImage.height()) + 1,
            left: ($tooltip.position().left + (($tooltip.outerWidth() - $pointImage.width() + globalOptions[$tooltip.attr("id").replace(/tooltip_/, "")].imageSpacing) / 2))
        };
    };

    function calculatePointImageRightPosition($tooltip, $pointImage) {
        return {
            top: $tooltip.position().top + (($tooltip.outerHeight() - $pointImage.height()) / 2),
            left: ($tooltip.position().left - $pointImage.width()) + 1
        };
    };

    /*
     Functions that calculate the right and bottom coordinates of an object
    */

    function getRightCoordinate($object) {
        return  $object.position().left + $object.outerWidth();
    };

    function getBottomCoordinate($object) {
        return $object.position().top + $object.outerHeight();
    };

})(jQuery);
    ;Infusion.scriptLoaded('/js/jquery/plugins/tooltip/jquery.tooltip.js');
    


/* FILE: /js/jquery/plugins/postJSON/jquery.postJSON.js */
jQuery.postJSON = function(url, data, callback) {
   jQuery.post(url, data, callback, "json");
};
    ;Infusion.scriptLoaded('/js/jquery/plugins/postJSON/jquery.postJSON.js');
    


/* FILE: /js/jquery/plugins/multiselect/jquery.multiselect.js */
(function(jQuery) {
    jQuery.fn.multiselect = function(opts) {
        var o = jQuery.extend({}, jQuery.fn.tooltip.defaults, opts);

        return this.each(function() {
            var $this = jQuery(this);
            var multiselectOptions = jQuery.meta ? jQuery.extend({}, o, $this.data()) : o;
            var $multiselect = null;

            multiselectOptions.className = multiselectOptions.className || "default";

            if(!multiselectOptions.name) {
                throw "'name' attribute not provided in multiselectOptions";
            }

            else if(!multiselectOptions.options) {
                throw "'options' attribute cannot be null"
            }

            else {
                if(multiselectOptions.options.options) {
                    multiselectOptions.options = multiselectOptions.options.options;
                }

                else if(multiselectOptions.json) {
                    eval("var options = " + multiselectOptions.options);
                    multiselectOptions.options = options.options;
                }

                $multiselect = createMultiSelect(multiselectOptions);
                $this.append($multiselect);
            }
        });
    };

    jQuery.fn.multiselect.defaults = {
        className: "default",
        tree: false,
        noRootInput: false,
        json: false,
        options: null,
        optionValue: null,
        optionKey: null,
        selectedValue: null,
        onToggle: null,
        onCheckAll: null,
        onUncheckAll: null
    };

    function createMultiSelect(multiselectOptions) {
        var $outerDiv = jQuery("<div></div>").attr("id", multiselectOptions.name + "_multiSelectOuterDiv")
                                             .addClass(multiselectOptions.className + "-skin-outer");
        var $controlDiv = buildControlDiv(multiselectOptions);
        var $innerDiv = buildInnerDiv(multiselectOptions);

        //Before we add our control, we check to see if one with the same name already exists. If it does, we
        //remove it.

        if(jQuery(multiselectOptions.name + "_multiSelectOuterDiv") > 0) {
            jQuery(multiselectOptions.name + "_multiSelectOuterDiv").remove();
        }

        $outerDiv.append($controlDiv).append($innerDiv);
        return $outerDiv;
    }

    function buildControlDiv(multiselectOptions) {
        var name = multiselectOptions.name;
        var className = multiselectOptions.className;

        var $controlDiv = jQuery("<div></div>").attr("id", name + "_multiSelectControlDiv")
                                               .addClass(className + "-control");

        var $checkWrapperSpan = jQuery("<span></span>").attr("id", name + "_multiSelectControlCheckWrapperSpan")
                                                       .addClass(className + "-icon-check-text");
        var $uncheckWrapperSpan = jQuery("<span></span>").attr("id", name + "_multiSelectControlUncheckWrapperSpan")
                                                         .addClass(className + "-icon-uncheck-text");

        var $checkIconSpan = jQuery("<span></span>").attr("id", name + "_multiSelectControlCheckWrapperSpan")
                                                    .addClass(className + "-icon").addClass(className + "-icon-check");
        var $checkTextSpan = jQuery("<span></span>").attr("id", name + "_multiSelectControlCheckTextSpan")
                                                    .addClass(className + "-icon").addClass(className + "-icon-text")
                                                    .text("Check All")
                                                    .click(function() {
            jQuery("input[name='" + multiselectOptions.name + "']").each(function() {
                var $checkbox = jQuery(this);
                $checkbox.attr("checked", true);
            });

            if(multiselectOptions.onCheckAll) {
                multiselectOptions.onCheckAll.apply(document.getElementsByName(multiselectOptions.name));
            }
        });

        var $uncheckIconSpan = jQuery("<span></span>").attr("id", name + "_multiSelectControlUncheckIconSpan")
                                                      .addClass(className + "-icon").addClass(className + "-icon-uncheck");
        var $uncheckTextSpan = jQuery("<span></span>").attr("id", name + "_multiSelectControlUncheckTextSpan")
                                                      .addClass(className + "-icon").addClass(className + "-icon-text")
                                                      .text("Uncheck All")
                                                      .click(function () {
            jQuery("input[name='" + multiselectOptions.name + "']").each(function() {
                var $checkbox = jQuery(this);
                $checkbox.removeAttr("checked");
            });

            if(multiselectOptions.onUncheckAll) {
                multiselectOptions.onUncheckAll.apply(document.getElementsByName(multiselectOptions.name));
            }
        });

        $controlDiv.append($checkWrapperSpan.append($checkIconSpan).append($checkTextSpan)).
                    append($uncheckWrapperSpan.append($uncheckIconSpan).append($uncheckTextSpan));

        return $controlDiv;
    }

    function buildInnerDiv(multiselectOptions) {
        var name = multiselectOptions.name;
        var className = multiselectOptions.className;
        var options = multiselectOptions.options;
        var optionKey = multiselectOptions.optionKey;
        var optionValue = multiselectOptions.optionValue;
        var selectedValue = multiselectOptions.selectedValue;

        var $innerDiv = jQuery("<div></div>").attr("id", name + "_multiSelectInnerDiv")
                                             .addClass(className + "-skin-inner");

        if(!multiselectOptions.tree) {

            var $ul = jQuery("<ul></ul>").addClass(className + '-multiselect');
            var index = 0;

            for(var option in options) {
                if(options.hasOwnProperty(option)) {
                    var checkboxData;

                    if(options.constructor == Array) {
                        checkboxData = getCheckboxValueAndText(options[option], optionKey, optionValue, index);
                    }

                    else if(options.constructor == Object) {
                        checkboxData = {
                            checkboxValue: option,
                            checkboxText: options[option]
                        };
                    }

                    $ul.append(buildLiWithInput(multiselectOptions, name, className, index, checkboxData, selectedValue, true));
                    index++;
                }
            }
        }

        else {
            var index = 0;

            for(var treeNumber in options) {
                if(options.hasOwnProperty(treeNumber)) {
                    var $ul = jQuery("<ul></ul>").attr("id", "optionTree" + treeNumber)
                                                 .addClass(className + "-multiselect");
                    var tree = options[treeNumber];
                    var root = tree.root;
                    var nodeStack = new Array();
                    var $currentUL = $ul;
                    var isRoot = true;

                    /*
                     An iterative algorithm seemed to be easier here. This is pre-order iterative n-ary tree traversal
                     */

                    nodeStack.push(root);

                    while(nodeStack.length > 0) {
                        var currentNode = nodeStack.pop();
                        var data = currentNode.data;
                        var children = currentNode.children;
                        var checkboxData = getCheckboxValueAndText(data, optionKey, optionValue, index);
                        var includeInput = !(isRoot && multiselectOptions.noRootInput); // if this node is the root and we don't want a root input, includeInput is false
                        
                        $currentUL.append(buildLiWithInput(multiselectOptions, name, className, index, checkboxData, selectedValue, includeInput));

                        if(children.length > 0) {
                            var $newUL = jQuery("<ul></ul>").addClass(className + "-with-padding");
                            $currentUL.append($newUL);
                            $currentUL = $newUL;

                            jQuery.each(children, function(index, value) {
                                nodeStack.push(value);
                            });

                            isRoot = false;
                        }

                        index++;
                    }
                }

                treeNumber++;
            }
        }

        $innerDiv.append($ul);

        return $innerDiv;
    }

    function getCheckboxValueAndText(data, optionKey, optionValue, index) {
        var checkboxValue;
        var checkboxText;

        if(optionKey && data[optionKey]) {
            checkboxValue = data[optionKey];
        }

        else if(data.id) {
            checkboxValue = data.id;
        }

        else {
            checkboxValue = index;
        }

        if(optionValue && data[optionValue]) {
            checkboxText = data[optionValue]
        }

        else {
            checkboxText = data.toString();
        }

        return {
            checkboxValue: checkboxValue,
            checkboxText: checkboxText
        };
    }

    function buildLiWithInput(multiselectOptions, name, className, index, checkboxData, selectedValue, includeInput) {
        var $li = jQuery("<li></li>").addClass(className + "-multiselect");
        var $label = jQuery("<label></label>").addClass(className + "-label");

        if(includeInput) {
            var $checkbox = jQuery("<input />").attr("type", "checkbox")
                                               .attr("name", name)
                                               .attr("id", name + index)
                                               .addClass(className + "-checkbox")
                                               .val(checkboxData.checkboxValue);

            if(selectedValue && jQuery.inArray(checkboxData.checkboxValue, selectedValue.split(",")) > -1) {
                $checkbox.attr("checked", true);
            }

            if(multiselectOptions.onToggle) {
                $checkbox.click(multiselectOptions.onToggle);
            }

            $li.append(
                    $label.append($checkbox).append(" " + checkboxData.checkboxText)
                    );
        }

        else {
            var $span = jQuery("<span></span>").addClass(className + "-no-root-text")
                                               .text(checkboxData.checkboxText);

            $li.append($label.append($span));
        }

        return $li;
    }
    
})(jQuery);
    ;Infusion.scriptLoaded('/js/jquery/plugins/multiselect/jquery.multiselect.js');
    


/* FILE: /resources/extension/jquery-plugin/jquery.safeRemove.js */
(function( $ ){
    // Workaround for IE bug: http://support.microsoft.com/kb/925014
    $.fn.safeRemove = function() {
        return this.each(function() {
            if (this.outerHTML) {
               this.outerHTML = " ";
            } else {
               $(this).remove();
            }
        });
    };
})( jQuery );
    ;Infusion.scriptLoaded('/resources/extension/jquery-plugin/jquery.safeRemove.js');
    


/* FILE: /js/regula/regula.js */
/*
 Regula: An annotation-based form-validation framework in Javascript
 Written By Vivin Paliath (http://vivin.net)
 License: BSD License
 Copyright (C) 2010-2011
 Version 1.2.3-SNAPSHOT
 */

/* for code completion */
var regula = {
    bind: function(options) {},
    unbind: function(options) {},
    custom: function(options) {},
    compound: function(options) {},
    override: function(options) {},
    validate: function(options) {},
    Constraint: {},
    Group: {},
	DateFormat: {}
};

regula = (function() {
    /*
        getElementsByClassName
        Developed by Robert Nyman, http://www.robertnyman.com
        Code/licensing: http://code.google.com/p/getelementsbyclassname/
    */
    var getElementsByClassName = function (className, tag, elm){

        if(document.getElementsByClassName && Object.prototype.getElementsByClassName === document.getElementsByClassName) {
            getElementsByClassName = function (className, tag, elm) {
                elm = elm || document;
                var elements = elm.getElementsByClassName(className),
                    nodeName = (tag)? new RegExp("\\b" + tag + "\\b", "i") : null,
                    returnElements = [],
                    current;
                for(var i=0, il=elements.length; i<il; i+=1){
                    current = elements[i];
                    if(!nodeName || nodeName.test(current.nodeName)) {
                        returnElements.push(current);
                    }
                }
                return returnElements;
            };
        }
        else if(document.evaluate) {
            getElementsByClassName = function (className, tag, elm) {
                tag = tag || "*";
                elm = elm || document;
                var classes = className.split(" "),
                    classesToCheck = "",
                    xhtmlNamespace = "http://www.w3.org/1999/xhtml",
                    namespaceResolver = (document.documentElement.namespaceURI === xhtmlNamespace)? xhtmlNamespace : null,
                    returnElements = [],
                    elements,
                    node;
                for(var j=0, jl=classes.length; j<jl; j+=1){
                    classesToCheck += "[contains(concat(' ', @class, ' '), ' " + classes[j] + " ')]";
                }
                try	{
                    elements = document.evaluate(".//" + tag + classesToCheck, elm, namespaceResolver, 0, null);
                }
                catch (e) {
                    elements = document.evaluate(".//" + tag + classesToCheck, elm, null, 0, null);
                }
                while((node = elements.iterateNext())) {
                    returnElements.push(node);
                }
                return returnElements;
            };
        }
        else {
            getElementsByClassName = function (className, tag, elm) {
                tag = tag || "*";
                elm = elm || document;
                var classes = className.split(" "),
                    classesToCheck = [],
                    elements = (tag === "*" && elm.all)? elm.all : elm.getElementsByTagName(tag),
                    current,
                    returnElements = [],
                    match;
                for(var k=0, kl=classes.length; k<kl; k+=1){
                    classesToCheck.push(new RegExp("(^|\\s)" + classes[k] + "(\\s|$)"));
                }
                for(var l=0, ll=elements.length; l<ll; l+=1){
                    current = elements[l];
                    match = false;
                    for(var m=0, ml=classesToCheck.length; m<ml; m+=1){
                        match = classesToCheck[m].test(current.className);
                        if(!match) {
                            break;
                        }
                    }
                    if(match) {
                        returnElements.push(current);
                    }
                }
                return returnElements;
            };
        }
        return getElementsByClassName(className, tag, elm);
    };

    /* regula code starts here */

    var Group = {
        Default: 0
    };

    var ReverseGroup = {
        0: "Default"
    };

    /* New groups are added to our 'enum' sequentially with the help of an explicit index that is maintained separately
       (see firstCustomGroupIndex). When groups are deleted, we need to remove them from the Group 'enum'. Simply
       removing them would be fine. But what we end up with are "gaps" in the indices. For example, assume that we added
       a new group called "New". Then regula.Group.New is mapped to 1 in regula.ReverseGroup, and 1 is mapped back to "New".
       Assume that we add another group called "Newer". So now what you have Newer -> 2 -> "Newer". Let's say we delete
       the "New" group. The existing indices are 0 and 2. As you can see, there is a gap. Now although the indices
       themselves don't mean anything (and we don't rely on their actual numerical values in anyway) when you now add
       another group, the index for that group will be 3. So repeated additions and deletions of groups will keep
       incrementing the index. I am uncomfortable with this (what if it increments past MAX_INT? Unlikely, but possible
       -- it doesn't hurt to be paranoid) and so I'd like to reuse deleted indices. For this reason I'm going to maintain
       a stack of deleted-group indices. When I go to add a new group, I'll first check this stack to see if there are
       any indices there. If there are, I'll use one. Conversely, when I delete a group, I'll add its index to this stack
     */
    var deletedGroupIndices = [];

    var Constraint = {
        Checked: 0,
        Selected: 1,
        Max: 2,
        Min: 3,
        Range: 4,
        Between: 4,
        NotBlank: 5,
        NotEmpty: 5,
        Blank: 6,
        Empty: 6,
        Pattern: 7,
        Matches: 7,
        Email: 8,
        IsAlpha: 9,
        IsNumeric: 10,
        IsAlphaNumeric: 11,
        CompletelyFilled: 12,
        PasswordsMatch: 13,
        Required: 14,
        Length: 15,
        Digits: 16,
        Past: 17,
        Future: 18
    };

    var ReverseConstraint = {
        0: "Checked",
        1: "Selected",
        2: "Max",
        3: "Min",
        4: "Range",
        5: "NotBlank",
        6: "Blank",
        7: "Pattern",
        8: "Email",
        9: "IsAlpha",
        10: "IsNumeric",
        11: "IsAlphaNumeric",
        12: "CompletelyFilled",
        13: "PasswordsMatch",
        14: "Required",
        15: "Length",
        16: "Digits",
        17: "Past",
        18: "Future"
    };
	
	var DateFormat = {
		DMY: "DMY",
		MDY: "MDY",
		YMD: "YMD"
	};

    var friendlyInputNames = {
        form: "The form",
        select: "The select box",
        textarea: "The text area",
        checkbox: "The checkbox",
        radio: "The radio button",
        text: "The text field",
        password: "The password"
    };

    var firstCustomIndex = 15;
    var firstCustomGroupIndex = 1;

    var constraintsMap = {
        Checked: {
            formSpecific: false,
            validator: checked,
            constraintType: Constraint.Checked,
            custom: false,
            compound: false,
            params: [],
            defaultMessage: "{label} needs to be checked."
        },

        Selected: {
            formSpecific: false,
            validator: selected,
            constraintType: Constraint.Selected,
            custom: false,
            compound: false,
            params: [],
            defaultMessage: "{label} needs to be selected."
        },

        Max: {
            formSpecific: false,
            validator: max,
            constraintType: Constraint.Max,
            custom: false,
            compound: false,
            params: ["value"],
            defaultMessage: "{label} needs to be lesser than or equal to {value}."
        },

        Min: {
            formSpecific: false,
            validator: min,
            constraintType: Constraint.Min,
            custom: false,
            compound: false,
            params: ["value"],
            defaultMessage: "{label} needs to be greater than or equal to {value}."
        },

        Range: {
            formSpecific: false,
            validator: range,
            constraintType: Constraint.Range,
            custom: false,
            compound: false,
            params: ["min", "max"],
            defaultMessage: "{label} needs to be between {min} and {max}."
        },

        NotBlank: {
            formSpecific: false,
            validator: notBlank,
            constraintType: Constraint.NotBlank,
            custom: false,
            compound: false,
            params: [],
            defaultMessage: "{label} cannot be blank."
        },

        Blank: {
            formSpecific: false,
            validator: blank,
            constraintType: Constraint.Blank,
            custom: false,
            compound: false,
            params: [],
            defaultMessage: "{label} needs to be blank."
        },

        Pattern: {
            formSpecific: false,
            validator: matches,
            constraintType: Constraint.Pattern,
            custom: false,
            compound: false,
            params: ["regex"],
            defaultMessage: "{label} needs to match {regex}{flags}."
        },

        Email: {
            formSpecific: false,
            validator: email,
            constraintType: Constraint.Email,
            custom: false,
            compound: false,
            params: [],
            defaultMessage: "{label} is not a valid email."
        },

        IsAlpha: {
            formSpecific: false,
            validator: isAlpha,
            constraintType: Constraint.IsAlpha,
            custom: false,
            compound: false,
            params: [],
            defaultMessage: "{label} can only contain letters."
        },

        IsNumeric: {
            formSpecific: false,
            validator: isNumeric,
            constraintType: Constraint.IsNumeric,
            custom: false,
            compound: false,
            params: [],
            defaultMessage: "{label} can only contain numbers."
        },

        IsAlphaNumeric: {
            formSpecific: false,
            validator: isAlphaNumeric,
            constraintType: Constraint.IsAlphaNumeric,
            custom: false,
            compound: false,
            params: [],
            defaultMessage: "{label} can only contain numbers and letters."
        },

        CompletelyFilled: {
            formSpecific: true,
            validator: completelyFilled,
            constraintType : Constraint.CompletelyFilled,
            custom: false,
            compound: false,
            params: [],
            defaultMessage: "{label} must be completely filled."
        },

        PasswordsMatch: {
            formSpecific: true,
            validator: passwordsMatch,
            constraintType: Constraint.PasswordsMatch,
            custom: false,
            compound: false,
            params: ["field1", "field2"],
            defaultMessage: "Passwords do not match."
        },

        Required: {
            formSpecific: false,
            validator: required,
            constraintType: Constraint.Required,
            custom: false,
            compound: false,
            params: [],
            defaultMessage: "{label} is required."
        },

        Length: {
            formSpecific: false,
            validator: length,
            constraintType: Constraint.Length,
            custom: false,
            compound: false,
            params: ["min", "max"],
            defaultMessage: "{label} length must be between {max} and {min}."
        },

        Digits: {
            formSpecific: false,
            validator: digits,
            constraintType: Constraint.Digits,
            custom: false,
            compound: false,
            params: ["integer", "fraction"],
            defaultMessage: "{label} must have up to {integer} digits and {fraction} fractional digits."
        },

        Past: {
            formSpecific: false,
            validator: past,
            constraintType: Constraint.Past,
            custom: false,
            compound: false,
            params: ["format"],
            defaultMessage: "{label} must be in the past."
        },

        Future: {
            formSpecific: false,
            validator: future,
            constraintType: Constraint.Future,
            custom: false,
            compound: false,
            params: ["format"],
            defaultMessage: "{label} must be in the future."
        }
    };

    /*
      compositionGraph is an internal data structure that I use to keep track of composing constraints and the
      relationships between them (composing constraints can contain other composing constraints). The main use of this
      data structure is to identify cycles during composition. This can only happen during calls to regula.override.
      Since cycles in the constraint-composition graph will lead to infinite loops, I need to detect them and throw
      an exception
     */

    var compositionGraph = {
        addNode: function(type, parent){},
        getNodeByType: function(type){},
        cycleExists: function(startNode){},
        getRoot: function(){}
    };

    compositionGraph = (function() {
        var typeToNodeMap = {};

        /* root is a special node that serves as the root of the composition tree/graph (works either way because a tree
           is a special case of a graph)
         */

        var root = {
            visited: false,
            name: "RootNode",
            type: -1,
            children: []
        };

        function addNode(type, parent) {
            var newNode = typeToNodeMap[type] == null ? {
                visited: false,
                name: ReverseConstraint[type],
                type: type,
                children: []
            } : typeToNodeMap[type];

            if(parent == null) {
                root.children[root.children.length] = newNode;
            }

            else {
                parent.children[parent.children.length] = newNode;
            }

            typeToNodeMap[type] = newNode;
        }

        function getNodeByType(type) {
            return typeToNodeMap[type];
        }

        function cycleExists(startNode) {
            var result = (function(node, path) {
                var result = {cycleExists: false, path: path};

                if(node.visited) {
                    result = {cycleExists: true, path: path};
                }

                else {
                    node.visited = true;
                    var i = 0;
                    while(i < node.children.length && !result.cycleExists) {
                        result = arguments.callee(node.children[i], path + "." + node.children[i].name);
                        i++;
                    }
                }

                return result;
            }(startNode, startNode.name));

            if(!result.cycleExists) {
                clearVisited();
            }

            return result;
        }

        function clearVisited() {
            (function(node) {
                node.visited = false;
                for(var i = 0; i < node.children.length; i++) {
                     arguments.callee(node.children[i]);
                }
            }(root));
        }

        function getRoot() {
            return root;
        }

        return {
            addNode: addNode,
            getNodeByType: getNodeByType,
            cycleExists: cycleExists,
            getRoot: getRoot
        };
    })();

    var boundConstraints = {Default: {}}; //Keeps track of all bound constraints. Keyed by Group -> Element Id -> RuleConstraint Name
    var validatedConstraints = {}; //Keeps track of constraints that have already been validated for a validation run. Cleared out each time validation is run.

    function checked() {
        return this.checked;
    }

    function selected() {
        return this.selectedIndex > 0;
    }

    function max(params) {
        return parseFloat(this.value) <= parseFloat(params["value"]);
    }

    function min(params) {
        return parseFloat(this.value) >= parseFloat(params["value"]);
    }

    function range(params) {
        return this.value.replace(/\s/g, "") != "" && parseFloat(this.value) <= parseFloat(params["max"]) && parseFloat(this.value) >= parseFloat(params["min"]);
    }

    function notBlank() {
        return this.value.replace(/\s/g, "") != "";
    }

    function blank() {
        return this.value.replace(/\s/g, "") == "";
    }

    function matches(params) {
        var re;

        if(typeof params["flags"] != "undefined") {
            re = new RegExp(params["regex"].replace(/^\//, "").replace(/\/$/, ""), params["flags"]);
        }

        else {
            re = new RegExp(params["regex"].replace(/^\//, "").replace(/\/$/, ""));
        }

        return re.test(this.value);
    }

    function email() {
        return /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i.test(this.value);
    }

    function isAlpha() {
        return /^[A-Za-z]+$/.test(this.value);
    }

    function isNumeric() {
        return /^-?[0-9]+$/.test(this.value);
    }

    function isAlphaNumeric() {
        return /^[0-9]+|[0-9A-Za-z]+$/.test(this.value);
    }

    function completelyFilled() {
        var unfilledElements = [];

        for(var i = 0; i < this.elements.length; i++) {
            var element = this.elements[i];

            if(!required.call(element)) {
                unfilledElements.push(element);
            }
        }

        return unfilledElements;
    }

    function passwordsMatch(params) {
        var failingElements = [];

        var passwordField1 = document.getElementById(params["field1"]);
        var passwordField2 = document.getElementById(params["field2"]);

        if(passwordField1.value != passwordField2.value) {
            failingElements = [passwordField1, passwordField2];
        }

        return failingElements;
    }

    function required() {
        var result = true;

        if(this.tagName) {
            if(this.tagName.toLowerCase() == "select") {
                result = selected.call(this);
            }

            else if(this.type.toLowerCase() == "checkbox" || this.type.toLowerCase() == "radio") {
                result = checked.call(this);
            }

            else if(this.tagName.toLowerCase() == "input" || this.tagName.toLowerCase() == "textarea") {
                if(this.type.toLowerCase() != "button") {
                    result = notBlank.call(this);
                }
            }
        }

        return result;
    }

    function length(params) {
        return (this.value.length >= params["min"] && this.value.length <= params["max"]);
    }

    function digits(params) {
        var parts = this.value.split(/\./);
        var result = false;

        if(parts.length == 1) {
            parts[1] = "";
        }

        if(params["integer"] > 0) {
            result = params[0].length <= params["integer"];
        }

        if(params["fraction"] > 0) {
            result = result && params[1].length <= params["fraction"];
        }

        return result;
    }

    function parseDates(params) {
       var DateFormatIndices = {
           YMD: {Year: 0, Month: 1, Day: 2},
           MDY: {Month: 0, Day: 1, Year: 2},
           DMY: {Day: 0, Month: 1, Year: 2}
       };

       var dateFormatIndices = DateFormatIndices[params["format"]];

       var separator = params["separator"];
       if(typeof params["separator"] === "undefined") {
           separator = /\//.test(this.value) ? "/" :
                                               /\./.test(this.value) ? "." :
                                                                       / /.test(this.value) ? " " : "";
       }

       var parts = this.value.split(separator);
       var dateToValidate = new Date(parts[dateFormatIndices.Year], parts[dateFormatIndices.Month] - 1, parts[dateFormatIndices.Day]);

       var dateToTestAgainst = new Date();
       if(typeof params["date"] !== "undefined") {
          parts = params["date"].split(separator);
          dateToTestAgainst = new Date(parts[dateFormatIndices.Year], parts[dateFormatIndices.Month] - 1, parts[dateFormatIndices.Day]);
       }

       return {dateToValidate: dateToValidate, dateToTestAgainst: dateToTestAgainst};
    }

    function past(params) {
       var dates = parseDates.call(this, params);
       return (dates.dateToValidate < dates.dateToTestAgainst);
    }

    function future(params) {
       var dates = parseDates.call(this, params);
       return (dates.dateToValidate > dates.dateToTestAgainst);
    }

    /* a meta-validator that validates member constraints of a composing constraint */

    function compoundValidator(params, currentGroup, compoundConstraint) {
        var composingConstraints = compoundConstraint.composingConstraints;
        var constraintViolations = [];

        for(var i = 0; i < composingConstraints.length; i++) {
            var composingConstraint = composingConstraints[i];
            var composingConstraintName = ReverseConstraint[composingConstraint.constraintType];

            /*
            Now we'll merge the parameters in the child constraints with the parameters from the parent
            constraint
             */

            var mergedParams = {};

            for(var paramName in composingConstraint.params) if(composingConstraint.params.hasOwnProperty(paramName) && paramName != "__size__") {
                put(mergedParams, paramName, composingConstraint.params[paramName]);
            }

            /* we're only going to override if the compound constraint was defined with required params */
            if(compoundConstraint.params.length > 0) {
                for(var paramName in params) if(params.hasOwnProperty(paramName) && paramName != "__size__") {
                    put(mergedParams, paramName, params[paramName]);
                }
            }

            var validationResult = runValidatorFor(currentGroup, this.id, composingConstraintName, mergedParams);

            if(!validationResult.constraintPassed) {
                var errorMessage = interpolateErrorMessage(this.id, composingConstraintName, mergedParams);
                var constraintViolation = {
                    group: currentGroup,
                    constraintName: composingConstraintName,
                    custom: constraintsMap[composingConstraintName].custom,
                    compound: constraintsMap[composingConstraintName].compound,
                    constraintParameters: composingConstraint.params,
                    failingElements: validationResult.failingElements,
                    message: errorMessage
                };

                if(!compoundConstraint.reportAsSingleViolation) {
                    constraintViolation.composingConstraintViolations = validationResult.composingConstraintViolations || [];
                }

                constraintViolations.push(constraintViolation);
            }
        }

        return constraintViolations;
    }

    /* this function validates a constraint definition to ensure that parameters match up */

    function validateConstraintDefinition(element, constraintName, definedParameters) {
        var result = {
            successful: true,
            message: "",
            data: null
        };

        if(element.tagName.toLowerCase() == "form" && !constraintsMap[constraintName].formSpecific) {
            result = {
                successful : false,
                message: generateErrorMessage(element, constraintName, "@" + constraintName + " is not a form constraint, but you are trying to bind it to a form"),
                data: null
            };
        }

        else if(element.tagName.toLowerCase() != "form" && constraintsMap[constraintName].formSpecific) {
            result = {
                successful: false,
                message: generateErrorMessage(element, constraintName, "@" + constraintName + " is a form constraint, but you are trying to bind it to a non-form element"),
                data: null
            };
        }

        else if((typeof element.type == "undefined" || (element.type.toLowerCase() != "checkbox" && element.type.toLowerCase() != "radio")) && constraintName == "Checked") {
            result = {
                successful: false,
                message: generateErrorMessage(element, constraintName, "@" + constraintName + " is only applicable to checkboxes and radio buttons. You are trying to bind it to an input element that is neither a checkbox nor a radio button."),
                data: null
            };
        }

        else if(element.tagName.toLowerCase() != "select" && constraintName == "Selected") {
            result = {
                successful: false,
                message: generateErrorMessage(element, constraintName, "@" + constraintName + " is only applicable to select boxes. You are trying to bind it to an input element that is not a select box."),
                data: null
            };
        }

        else {
            var parameterResult = ensureAllRequiredParametersPresent(element, constraintsMap[constraintName], definedParameters);

            if(parameterResult.error) {
                result = {
                    successful: false,
                    message: parameterResult.message,
                    data: null
                };
            }

            else {
                result.data = definedParameters;
            }
        }

        return result;
    }

    function ensureAllRequiredParametersPresent(element, constraint, receivedParameters) {
        var result = {
            error: false,
            message: ""
        };

        if(receivedParameters.__size__ < constraint.params.length) {
            result = {
                error: true,
                message: generateErrorMessage(element, ReverseConstraint[constraint.constraintType], "@" + ReverseConstraint[constraint.constraintType] + " expects at least " + constraint.params.length +
                         " parameter(s). However, you have provided only " + receivedParameters.__size__),
                data: null
            };
        }

        var missingParams = [];
        for(var j = 0; j < constraint.params.length; j++) {
            var param = constraint.params[j];

            if(typeof receivedParameters[param] == "undefined") {
                missingParams.push(param);
            }
        }

        if(missingParams.length > 0) {
            result = {
                error: true,
                message: generateErrorMessage(element, ReverseConstraint[constraint.constraintType], "You seem to have provided some optional or required parameters for @" + ReverseConstraint[constraint.constraintType] +
                         ", but you are still missing the following " + missingParams.length + " required parameters(s): " + explode(missingParams, ", ")),
                data: null
            };
        }

        return result;
    }

    /* this function creates a constraint and binds it to the element specified using the constraint name and defined parameters */

    function createConstraintFromDefinition(element, constraintName, definedParameters) {
        var groupParamValue = "";

        //Regex that checks to see if Default is explicitly defined in the groups parameter
        var re = new RegExp("^" + ReverseGroup[Group.Default] + "$|" + "^" + ReverseGroup[Group.Default] + ",|," + ReverseGroup[Group.Default] + ",|," + ReverseGroup[Group.Default] + "$");

        var result = {
            successful: true,
            message: "",
            data: null
        };

        //If a "groups" parameter has not been specified, we'll create one and add "Default" to it since all elements
        //belong to the "Default" group implicitly
        if(!definedParameters["groups"]) {
            put(definedParameters, "groups", ReverseGroup[Group.Default]);
        }

        groupParamValue = definedParameters["groups"].replace(/\s/g, "");
        
        //If a "groups" parameter was defined, but it doesn't contain the "Default" group, we add it to groupParamValue
        //explicitly and also update the "groups" parameter for this constraint
        if(!re.test(groupParamValue)) {
            groupParamValue = ReverseGroup[Group.Default] + "," + groupParamValue;
            definedParameters["groups"] = groupParamValue;
        }

        var groups = groupParamValue.split(/,/);

        for(var i = 0; i < groups.length; i++) {

            var group = groups[i];

            if(!boundConstraints[group]) {

                var newIndex = -1;

                if(deletedGroupIndices.length > 0) {
                    newIndex = deletedGroupIndices.pop();
                }

                else {
                    newIndex = firstCustomGroupIndex++;
                }

                Group[group] = newIndex;
                ReverseGroup[newIndex] = group;
                boundConstraints[group] = {};
            }

            if(!boundConstraints[group][element.id]) {
                boundConstraints[group][element.id] = {};
            }

            boundConstraints[group][element.id][constraintName] = definedParameters;
        }
    }

    /* a few basic utility functions */

    function exists(array, value) {
        var found = false;
        var i = 0;

        while(!found && i < array.length) {
            found = value == array[i];
            i++;
        }

        return found;
    }

    function explode(array, delimeter) {
        var str = "";

        for(var i = 0; i < array.length; i++) {
            str += array[i] + delimeter;
        }

        return str.replace(new RegExp(delimeter + "$"), "");
    }

    function put(map, key, value) {
        if(!map.__size__) {
           map.__size__ = 0;
        }

        if(!map[key]) {
           map.__size__++;
        }

        map[key] = value;
    }

    function isMapEmpty(map) {
        for(var key in map) if(map.hasOwnProperty(key)) {
            return false;
        }

        return true;
    }

    function explodeParameters(options) {
        var str = "function received: {";
        for(var argument in options) if(options.hasOwnProperty(argument))  {

            if(typeof options[argument] == "string") {
                str += argument + ": " + options[argument] + ", ";
            }

            else if(options[argument].length) { //we need this to be an array
                str += argument + ": [" + explode(options[argument], ", ") + "], "
            }
        }

        str = str.replace(/, $/, "") + "}";
        return str;
    }

    function generateErrorMessage(element, constraintName, message) {
        var errorMessage = "";

        if(element != null) {
            errorMessage = element.id;

            if(constraintName == "" || constraintName == null || constraintName == undefined) {
                errorMessage += ": ";
            }

            else {
                errorMessage += "." + constraintName + ": ";
            }
        }

        else {
            if(constraintName != "" && constraintName != null && constraintName != undefined) {
                errorMessage = "@" + constraintName + ": "
            }
        }

        return errorMessage + message;
    }

    function removeElementFromGroupIfGroupIsEmpty(id, group) {
       if(isMapEmpty(boundConstraints[group][id])) {
          delete boundConstraints[group][id];

          if(isMapEmpty(boundConstraints[group])) {
              delete boundConstraints[group];

              var groupIndex = Group[group];
              delete Group[group];
              delete ReverseGroup[groupIndex];

              deletedGroupIndices.push(groupIndex);
          }
       }
    }

    /*
     * This is the parser that parses constraint definitions. The recursive-descent parser is actually defined inside
     * the 'parse' function (I've used inner functions to encapsulate the parsing logic).
     *
     * The parse function also contains a few other utility functions that are only related to parsing
     */

    function parse(element, constraintDefinitionString) {
        var currentConstraintName = "";
        var tokens = tokenize({
            str: trim(constraintDefinitionString.replace(/\s*\n\s*/g, "")),
            delimiters: "@()[]=,\"\\/-\\.",
            returnDelimiters: true,
            returnEmptyTokens: false
        });

        return constraints(tokens);

        /** utility functions. i.e., functions not directly related to parsing start here **/

        function trim(str) {
            return str ? str.replace(/^\s+/, "").replace(/\s+$/, "") : "";
        }

        function peek(arr) {
            return arr[0];
        }

        function tokenize(options) {
            var str = options.str;
            var delimiters = options.delimiters.split("");
            var returnDelimiters = options.returnDelimiters || false;
            var returnEmptyTokens = options.returnEmptyTokens || false;
            var tokens = [];
            var lastTokenIndex = 0;

            for(var i = 0; i < str.length; i++) {
                if(exists(delimiters, str.charAt(i))) {
                    var token = str.substring(lastTokenIndex, i);

                    if(token.length == 0) {
                        if(returnEmptyTokens) {
                            tokens.push(token);
                        }
                    }

                    else {
                        tokens.push(token);
                    }

                    if(returnDelimiters) {
                        tokens.push(str.charAt(i));
                    }

                    lastTokenIndex = i + 1;
                }
            }

            if(lastTokenIndex < str.length) {
                var token = str.substring(lastTokenIndex, str.length);

                if(token.length == 0) {
                    if(returnEmptyTokens) {
                        tokens.push(token);
                    }
                }

                else {
                    tokens.push(token);
                }
            }

            return tokens;
        }

        /** the recursive-descent parser starts here **/
        /** it parses according to the following EBNF **/

        /*
            constraints            ::= { constraint }
            constraint             ::= "@", constraint-def
            constraint-def         ::= constraint-name, param-def
            constraint-name        ::= valid-starting-char { valid-char }
            valid-starting-char    ::= [A-Za-z_]
            valid-char             ::= [0-9A-Za-z_]
            param-def              ::= [ "(", [ param { ",", param } ], ")" ]
            param                  ::= param-name, "=", param-value
            param-name             ::= valid-starting-char { valid-char }
            param-value            ::= number | quoted-string | regular-expression | boolean | group-definition
            number                 ::= positive | negative
            negative               ::= "-", positive
            positive               ::= integer, [ fractional ] | fractional
            integer                ::= digit { digit }
            fractional             ::= ".", integer
            quoted-string          ::= "\"", { char }, "\""
            boolean                ::= true | false
            char                   ::= .
            regular-expression     ::= "/", { char }, "/"
            group-definition       ::= "[", [ group { ",", group } ] "]"
            group                  ::= valid-starting-char { valid-char }
            
         */

        function constraints(tokens) {
            var result = {
                successful: true,
                message: "",
                data: null
            };

            while(tokens.length > 0 && result.successful) {
                result = constraint(tokens);
            }

            return result;
        }

        function constraint(tokens) {
            var result = {
                successful: true,
                message: "",
                data: null
            };

            var token = tokens.shift();

            //get rid of spaces if any
            if(trim(token).length == 0) {
                token = tokens.shift();
            }

            if(token == "@") {
                result = constraintDef(tokens)
            }

            else {
                result = {
                    successful: false,
                    message: generateErrorMessage(element, currentConstraintName, "Invalid constraint. RuleConstraint definitions need to start with '@'") + " " + result.message,
                    data: null
                };
            }

            return result;
        }

        function constraintDef(tokens) {
            var alias = {
                Between: "Range",
                Matches: "Pattern",
                Empty: "Blank",
                NotEmpty: "NotBlank"
            };

            var result = constraintName(tokens);

            if(result.successful) {
                currentConstraintName = result.data;

                currentConstraintName = alias[currentConstraintName] ? alias[currentConstraintName] : currentConstraintName;

                if(constraintsMap[currentConstraintName]) {
                    result = paramDef(tokens);

                    if(result.successful) {
                        result = validateConstraintDefinition(element, currentConstraintName, result.data);

                        if(result.successful) {
                            createConstraintFromDefinition(element, currentConstraintName, result.data);
                        }
                    }
                }

                else {
                    result = {
                        successful: false,
                        message: generateErrorMessage(element, currentConstraintName, "I cannot find the specified constraint name. If this is a custom constraint, you need to define it before you bind to it") + " " + result.message,
                        data: null
                    };
                }
            }

            else {
                result = {
                    successful: false,
                    message: generateErrorMessage(element, currentConstraintName, "Invalid constraint name in constraint definition") + " " + result.message,
                    data: null
                };
            }

            return result;
        }

        function constraintName(tokens) {
            var token = trim(tokens.shift());
            var result = validStartingCharacter(token.charAt(0));

            if(result.successful) {
                var i = 1;
                while(i < token.length && result.successful) {
                    result = validCharacter(token.charAt(i));
                    i++;
                }

                if(result.successful) {
                    result.data = token;
                }
            }

            else {
                result = {
                    successful: false,
                    message: generateErrorMessage(element, currentConstraintName, "Invalid starting character for constraint name. Can only include A-Z, a-z, and _") + " " + result.message,
                    data: null
                };
            }


            return result;
        }

        function validStartingCharacter(character) {
            var result = {
                successful: true,
                message: "",
                data: null
            };

            if(!/[A-Za-z_]/.test(character) || typeof character === "undefined" || character == null) {
                result = {
                    successful: false,
                    message: generateErrorMessage(element, currentConstraintName, "Invalid starting character"),
                    data: null
                };
            }

            return result;
        }

        function validCharacter(character) {
            var result = {
                successful: true,
                message: "",
                data: null
            };

            if(!/[0-9A-Za-z_]/.test(character)) {
                result = {
                    successful: false,
                    message: generateErrorMessage(element, currentConstraintName, "Invalid character in identifier. Can only include 0-9, A-Z, a-z, and _") + " " + result.message,
                    data: null
                };
            }

            return result;
        }

        function paramDef(tokens) {
            var result = {
                successful: true,
                message: "",
                data: {}
            };

            if(peek(tokens) == "(") {
                tokens.shift(); // get rid of the (

                var data = {};

                if(peek(tokens) == ")") {
                    tokens.shift(); //get rid of the )
                }

                else {
                    result = param(tokens);

                    if(result.successful) {
                        put(data, result.data.name, result.data.value);

                        //get rid of spaces
                        if(trim(peek(tokens)).length == 0) {
                            tokens.shift();
                        }

                        while(tokens.length > 0 && peek(tokens) == "," && result.successful) {

                            tokens.shift();
                            result = param(tokens);

                            if(result.successful) {
                                put(data, result.data.name, result.data.value);

                                 //get rid of spaces;
                                if(trim(peek(tokens)).length == 0) {
                                    tokens.shift();
                                }
                            }
                        }

                        if(result.successful) {
                            var token = tokens.shift();

                            //get rid of spaces
                            if(trim(token).length == 0) {
                                token = tokens.shift();
                            }

                            if(token != ")") {
                                result = {
                                    successful: false,
                                    message: generateErrorMessage(element, currentConstraintName, "Cannot find matching closing ) in parameter list") + " " + result.message,
                                    data: null
                                };
                            }

                            else {
                                result.data = data;
                            }
                        }
                    }

                    else {
                        result = {
                            successful: false,
                            message: generateErrorMessage(element, currentConstraintName, "Invalid parameter definition") + " " + result.message,
                            data: null
                        };
                    }
                }
            }

            else if(peek(tokens) !== undefined && peek(tokens) != "@") {
                //The next token MUST be a @ if we are expecting further constraints
                result = {
                    successful: false,
                    message: generateErrorMessage(element, currentConstraintName, "Unexpected character '" + peek(tokens) + "'" + " after constraint definition") + " " + result.message,
                    data: null
                };
            }

            return result;
        }

        function param(tokens) {
            var result = paramName(tokens);

            if(result.successful) {
                var parameterName = result.data;
                var token = tokens.shift();

                if(token == "=") {
                    result = paramValue(tokens);

                    if(result.successful) {
                        result.data = {
                            name: parameterName,
                            value: result.data
                        };
                    }

                    else {
                        result = {
                            successful: false,
                            message: generateErrorMessage(element, currentConstraintName, "Invalid parameter value") + " " + result.message,
                            data: null
                        };
                    }
                }

                else {
                    tokens.unshift(token);
                    result = {
                        successful: false,
                        message: generateErrorMessage(element, currentConstraintName, "'=' expected after parameter name" + " " + result.message),
                        data: null
                    };
                }
            }

            else {
                result = {
                    successful: false,
                    message: generateErrorMessage(element, currentConstraintName, "Invalid parameter name. You might have unmatched parentheses") + " " + result.message,
                    data: null
                };
            }

            return result;
        }

        function paramName(tokens) {
            var token = trim(tokens.shift());

            //get rid of space
            if(token.length == 0) {
                token = tokens.shift();
            }

            var result = {
                successful: false,
                message: generateErrorMessage(element, currentConstraintName, "Invalid starting character for parameter name. Can only include A-Z, a-z, and _"),
                data: null
            };

            if(typeof token != "undefined") {
                result = validStartingCharacter(token.charAt(0));

                if(result.successful) {
                    var i = 1;
                    while(i < token.length && result.successful) {
                        result = validCharacter(token.charAt(i));
                        i++;
                    }

                    if(result.successful) {
                        result.data = token;
                    }
                }

                else {
                    result = {
                        successful: false,
                        message: generateErrorMessage(element, currentConstraintName, "Invalid starting character for parameter name. Can only include A-Z, a-z, and _") + " " + result.message,
                        data: null
                    };
                }
            }

            return result;
        }

        function paramValue(tokens) {

            //get rid of spaces
            if(trim(peek(tokens)).length == 0) {
                tokens.shift();
            }

            var result = {
                successful: true,
                message: "",
                data: []
            };

            if(peek(tokens) == ")") {
                result = {
                    successful: false,
                    message: generateErrorMessage(element, currentConstraintName, "Parameter value expected") + " " + result.message,
                    data: null
                };
            }

            else {
                result = number(tokens);

                var message = result.message;

                if(!result.successful) {
                    result = quotedString(tokens);

                    result.message = result.message + " " + message;
                    message = result.message;

                    if(!result.successful) {
                        result = regularExpression(tokens);

                        result.message = result.message + " " + message;
                        message = result.message;

                        if(!result.successful) {
                            result = booleanValue(tokens);

                            result.message = result.message + " " + message;
                            message = result.message;

                            if(!result.successful) {
                                result = groupDefinition(tokens);

                                result.message = result.message + " " + message;
                                message = result.message;

                                if(!result.successful) {
                                    result = {
                                        successful: false,
                                        message: generateErrorMessage(element, currentConstraintName, "Parameter value must be a number, quoted string, regular expression, or a boolean") + " " + message,
                                        data: null
                                    };
                                }
                            }
                        }
                    }
                }
            }

            return result;
        }

        function number(tokens) {
            var result = negative(tokens);

            if(!result.successful) {
                result = positive(tokens);

                if(!result.successful) {
                    result = {
                        successful: false,
                        message: generateErrorMessage(element, currentConstraintName, "Parameter value is not a number") + " " + result.message,
                        data: null
                    };
                }
            }

            return result;
        }

        function negative(tokens) {
            var token = tokens.shift();
            var result = {
                successful: true,
                message: "",
                data: null
            };

            if(token == "-") {
                result = positive(tokens);
                if(result.successful) {
                    result.data = token + result.data;
                }
            }

            else {
                tokens.unshift(token);
                result = {
                    successful: false,
                    message: generateErrorMessage(element, currentConstraintName, "Not a negative number"),
                    data: null
                };
            }

            return result;
        }

        function positive(tokens) {

            var result = null;

            if(peek(tokens) != ".") {
                result = integer(tokens);

                if(peek(tokens) == ".") {
                    var integerPart = result.data;

                    result = fractional(tokens);

                    if(result.successful) {
                        result.data = integerPart + result.data;
                    }

                }
            }

            else {
                result = fractional(tokens);
            }

            if(!result.successful) {
                result = {
                    successful: false,
                    message: generateErrorMessage(element, currentConstraintName, "Not a positive number") + " " + result.message,
                    data: null
                };
            }

            return result;
        }

        function fractional(tokens) {

            var token = tokens.shift(); //get rid of the .
            var result = integer(tokens);

            if(result.successful) {
                result.data = token + result.data;
            }

            else {
                result = {
                    successful: false,
                    message: generateErrorMessage(element, currentConstraintName, "Not a valid fraction"),
                    data: null
                };
            }

            return result;
        }

        function integer(tokens) {
            var token = trim(tokens.shift());
            var result = digit(token.charAt(0));

            if(result.successful) {
                var i = 1;
                while(i < token.length && result.successful) {
                    result = digit(token.charAt(i));
                    i++;
                }

                if(result.successful) {
                    result.data = token;
                }
            }

            else {
                tokens.unshift(token);
                result = {
                    successful: false,
                    message: generateErrorMessage(element, currentConstraintName, "Not a valid integer") + " " + result.message,
                    data: []
                };
            }

            return result;
        }

        function digit(character) {
            var result = {
                successful: true,
                message: "",
                data: null
            };

            if(!/[0-9]/.test(character)) {
                result = {
                    successful: false,
                    message: generateErrorMessage(element, currentConstraintName, "Not a valid digit"),
                    data: null
                };
            }

            return result;
        }

        function quotedString(tokens) {
            var token = tokens.shift();
            var data = "";
            var result = {
                successful: true,
                message: "",
                data: null
            };

            if(token == "\"") {
                var done = false;

                while(tokens.length > 0 && result.successful && !done) {

                    if(peek(tokens) == "\"") {
                        done = true;
                        tokens.shift(); //get rid of "
                    }

                    else {
                        result = character(tokens);
                        data += result.data;
                    }
                }

                if(!done) {
                    result = {
                        successful: false,
                        message: generateErrorMessage(element, currentConstraintName, "Unterminated string literal"),
                        data: null
                    };
                }
            }

            else {
                tokens.unshift(token);
                result = {
                    successful: false,
                    message: generateErrorMessage(element, currentConstraintName, "Invalid quoted string"),
                    data: null
                };
            }

            // This boolean expression is the result of the simplification of the following truth table:
            // S | D | R
            // 1 | 0 | 0
            // 1 | 1 | 1 << what we need
            // 0 | 0 | 0
            // 0 | 1 | 0

            result.successful = result.successful && done;
            result.data = data;
            return result;
        }

        function character(tokens) {
            var data = "";
            var token = tokens.shift();

            if(token == "\\") {
                data = tokens.shift();
            }

            return {
                successful: true,
                message: "",
                data: token + data
            }; //match any old character
        }

        function regularExpression(tokens) {
            var data = "";
            var token = tokens.shift();
            var result = {
                successful: true,
                message: "",
                data: null
            };

            if(token == "/") {
                data = token;
                var done = false;

                while(tokens.length > 0 && result.successful && !done) {

                    if(peek(tokens) == "/") {
                        data += tokens.shift();
                        done = true;
                    }

                    else {
                        result = character(tokens);
                        data += result.data;
                    }
                }

                if(!done) {
                    result = {
                        successful: false,
                        message: generateErrorMessage(element, currentConstraintName, "Unterminated regex literal"),
                        data: null
                    };
                }
            }

            else {
                tokens.unshift(token);
                result = {
                    successful: false,
                    message: generateErrorMessage(element, currentConstraintName, "Not a regular expression"),
                    data: null
                };
            }

            result.successful = result.successful && done;
            result.data = data;
            return result;
        }
       
        function booleanValue(tokens) {
            var token = tokens.shift();
            var result = {
                successful: true,
                message: "",
                data: null
            };

            if(trim(token) == "true" || trim(token) == "false") {
                result = {
                    successful: true,
                    message: "",
                    data: token
                };
            }

            else {
                tokens.unshift(token);
                result = {
                    successful: false,
                    message: generateErrorMessage(element, currentConstraintName, "Not a boolean"),
                    data: null
                };
            }

            return result;
        }

        function groupDefinition(tokens) {
            var data = "";
            var token = tokens.shift();
            var result = {
                successful: true,
                message: "",
                data: null
            };

            if(token == "[") {

                //get rid of spaces
                if(trim(peek(tokens)).length == 0) {
                    tokens.shift();
                }

                if(peek(tokens) == "]") {
                    result = {
                        successful: true,
                        message: "",
                        data: ""
                    };
                }

                else {
                    result = group(tokens);
                }

                if(result.successful) {
                    data = result.data;

                    //get rid of spaces
                    if(trim(peek(tokens)).length == 0) {
                        tokens.shift();
                    }

                    while(tokens.length > 0 && peek(tokens) == "," && result.successful) {
                        tokens.shift();
                        result = group(tokens);

                        data += "," + result.data;

                        if(trim(peek(tokens)).length == 0) {
                            tokens.shift();
                        }
                    }

                    result.data = data;

                    token = tokens.shift();

                    //get rid of spaces
                    if(trim(token).length == 0) {
                        tokens.shift();
                    }

                    if(token != "]") {
                        result = {
                            successful: false,
                            message: generateErrorMessage(element, currentConstraintName, "Cannot find matching closing ] in group definition") + " " + result.message,
                            data: null
                        };
                    }
                }

                else {
                    result = {
                        successful: false,
                        message: generateErrorMessage(element, currentConstraintName, "Invalid group definition") + " " + result.message,
                        data: null
                    };
                }
            }

            else {
                tokens.unshift(token);
                result = {
                    successful: false,
                    message: generateErrorMessage(element, currentConstraintName, "Not a valid group definition"),
                    data: null
                };
            }

            return result;
        }

        function group(tokens) {
            var result = {
                successful: true,
                message: "",
                data: ""
            };

            var token = trim(tokens.shift());

            //get rid of space
            if(token.length == 0) {
                token = tokens.shift();
            }

            result = validStartingCharacter(token.charAt(0));

            if(result.successful) {
                var i = 1;
                while(i < token.length && result.successful) {
                    result = validCharacter(token.charAt(i));
                    i++;
                }

                if(result.successful) {
                    result.data = token;
                }
            }

            else {
                result = {
                    successful: false,
                    message: generateErrorMessage(element, currentConstraintName, "Invalid starting character for group name. Can only include A-Z, a-z, and _") + " " + result.message,
                    data: null
                };
            }

            return result;
        }
    }

    function custom(options) {

        if(!options) {
            throw "regula.custom expects options";
        }

        var name = options.name;
        var formSpecific = options.formSpecific || false;
        var validator = options.validator;
        var params = options.params || [];
        var defaultMessage = options.defaultMessage || "";

        /* handle attributes. throw exceptions if they are not sane */

        /* name attribute*/
        if(!name) {
            throw "regula.custom expects a name attribute in the options argument";
        }

        else if(typeof name != "string") {
            throw "regula.custom expects the name attribute in the options argument to be a string";
        }

        else if(name.replace(/\s/g, "").length == 0) {
            throw "regula.custom cannot accept an empty string for the name attribute in the options argument";
        }

        /* formSpecific attribute */
        if(typeof formSpecific != "boolean") {
            throw "regula.custom expects the formSpecific attribute in the options argument to be a boolean";
        }

        /* validator attribute */
        if(!validator) {
            throw "regula.custom expects a validator attribute in the options argument";
        }

        else if(typeof validator != "function") {
            throw "regula.custom expects the validator attribute in the options argument to be a function";
        }

        /* params attribute */
        if(params.constructor.toString().indexOf("Array") < 0) {
            throw "regula.custom expects the params attribute in the options argument to be an array";
        }

        /* defaultMessage attribute */
        if(typeof defaultMessage != "string") {
            throw "regula.custom expects the defaultMessage attribute in the options argument to be a string";
        }

        if(constraintsMap[name]) {
            throw "There is already a constraint called " + name + ". If you wish to override this constraint, use regula.override";
        }

        else {
            Constraint[name] = firstCustomIndex;
            ReverseConstraint[firstCustomIndex++] = name;
            constraintsMap[name] = {
                formSpecific: formSpecific,
                validator: validator,
                constraintType: Constraint[name],
                custom: true,
                compound: false,
                params: params,
                defaultMessage: defaultMessage
            };           
        }
    }

    function compound(options) {

        if(!options) {
            throw "regula.compound expects options";
        }

        var name = options.name;
        var constraints = options.constraints || [];
        var formSpecific = options.formSpecific || false;
        var defaultMessage = options.defaultMessage || "";
        var params = options.params || [];
        var reportAsSingleViolation = typeof options.reportAsSingleViolation == "undefined" ? false : options.reportAsSingleViolation;

        if(!name) {
            throw "regula.compound expects a name attribute in the options argument";
        }

        if(typeof name != "string") {
            throw "regula.compound expects name to be a string parameter";
        }

        /* params attribute */
        if(params.constructor.toString().indexOf("Array") < 0) {
            throw "regula.compound expects the params attribute in the options argument to be an array";
        }

        if(constraints.length == 0) {
            throw "regula.compound expects an array of composing constraints under a constraints attribute in the options argument";
        }

        if(constraintsMap[name]) {
            throw "regula.compound: There is already a constraint called " + name + ". If you wish to override this constraint, use regula.override";
        }

        checkComposingConstraints(name, constraints, params);
        
        Constraint[name] = firstCustomIndex;
        ReverseConstraint[firstCustomIndex++] = name;
        constraintsMap[name] = {
            formSpecific: formSpecific,
            constraintType: Constraint[name],
            custom: true,
            compound: true,
            params: params,
            reportAsSingleViolation: reportAsSingleViolation,
            composingConstraints: constraints,
            defaultMessage: defaultMessage,
            validator: compoundValidator
        };

        /* now let's update our graph */
        updateCompositionGraph(name, constraints);
    }

    function updateCompositionGraph(constraintName, composingConstraints) {
        var graphNode = compositionGraph.getNodeByType(Constraint[constraintName]);

        if(graphNode == null) {
            compositionGraph.addNode(Constraint[constraintName], null);
            graphNode = compositionGraph.getNodeByType(Constraint[constraintName]);
        }

        for(var i = 0; i < composingConstraints.length; i++) {
            var composingConstraintName = ReverseConstraint[composingConstraints[i].constraintType];
            var composingConstraint = constraintsMap[composingConstraintName];
            
            if(composingConstraint.compound) {
                compositionGraph.addNode(composingConstraint.constraintType, graphNode);
            }
        }
    }

    function checkComposingConstraints(name, constraints, params) {
        var constraintList = [];

        for(var i = 0; i < constraints.length; i++) {
            if(!constraints[i].constraintType) {
                throw "In compound constraint " + name + ": A composing constraint has no constraint type specified."
            }

            else {
                constraintList.push(constraintsMap[ReverseConstraint[constraints[i].constraintType]]);
            }
        }

        for(var i = 0; i < constraints.length; i++) {
            var constraint = constraints[i];
            var constraintName = ReverseConstraint[constraint.constraintType];
            var definedParameters = {};

            constraint.params = constraint.params || {__size__: 0};

            for(var paramName in constraint.params) if(constraint.params.hasOwnProperty(paramName)) {
                put(definedParameters, paramName, constraint.params[paramName]);
            }

            /*
             Now we will combine the parameters from the compound-constraint parameter-definition into the params map
             for the composing constraint. Of course, these parameters won't have any values; we just want to make sure
             that we copy them over so that we can be sure that the composing-constraint contains all the required
             parameters. The actual values for any parameters inherited from the compound constraint won't be filled in
             until we evaluate the constraints (i.e., during validation)
            */

            for(var j = 0; j < params.length; j++) {
                put(definedParameters, params[j], null);
            }

            var result = ensureAllRequiredParametersPresent(null, constraintsMap[constraintName], definedParameters);

            if(result.error) {
                throw "In compound constraint " + name + ": " + result.message;
            }
        }
    }

    function override(options) {

        if(!options) {
            throw "regula.override expects options";
        }

        if(typeof options.constraintType == "undefined") {
            throw "regula.override expects a constraintType attribute in the options argument";
        }

        var name = ReverseConstraint[options.constraintType];

        if(typeof Constraint[name] == "undefined") {
            throw "regula.override: A constraint called " + name + " has not been defined, so I cannot override it";
        }

        else {
            /* for custom constraints, you can override anything. for built-in constraints however, you can only override the default message */
            var formSpecific = constraintsMap[name].custom ? options.formSpecific || constraintsMap[name].formSpecific : constraintsMap[name].formSpecific;
            var validator = constraintsMap[name].custom && !constraintsMap[name].compound ? options.validator || constraintsMap[name].validator : constraintsMap[name].validator;
            var params = constraintsMap[name].custom ? options.params || constraintsMap[name].params : constraintsMap[name].params;
            var defaultMessage = options.defaultMessage || constraintsMap[name].defaultMessage;
            var compound = constraintsMap[name].compound;
            var composingConstraints = options.constraints || constraintsMap[name].constraints;

            if(typeof formSpecific != "boolean") {
                throw "regula.override expects the formSpecific attribute in the options argument to be a boolean";
            }

            if(typeof validator != "function") {
                throw "regula.override expects the validator attribute in the options argument to be a function";
            }

            if(params.constructor.toString().indexOf("Array") < 0) {
                throw "regula.override expects the params attribute in the options argument to be an array";
            }

            if(typeof defaultMessage != "string") {
                throw "regula.override expects the defaultMessage attribute in the options argument to be a string";
            }

            if(compound) {
                checkComposingConstraints(name, composingConstraints, params);

                /* now let's update our graph */
                updateCompositionGraph(name, composingConstraints);

                /* we need to see if a cycle exists in our graph */
                var result = compositionGraph.cycleExists(compositionGraph.getNodeByType(options.constraintType));

                if(result.cycleExists) {
                    throw "regula.override: The overriding composing-constraints you have specified have created a cyclic composition: " + result.path;
                }
            }

            constraintsMap[name] = {
                formSpecific: formSpecific,
                constraintType: Constraint[name],
                custom: true,
                compound: compound,
                params: params,
                composingConstraints: composingConstraints,
                defaultMessage: defaultMessage,
                validator: validator
            };
        }
    }

    function unbind(options) {

        if(typeof options == "undefined" || !options) {
            boundConstraints = {Default: {}};
        }

        else {
            if(typeof options.id == "undefined") {
                throw "regula.unbind requires an id if options are provided";
            }

            var id = options.id;
            var constraints = options.constraints || [];

            if(constraints.length == 0) {
                for(var group in boundConstraints) if(boundConstraints.hasOwnProperty(group)) {
                    removeElementFromGroupIfGroupIsEmpty(id, group);
                }
            }

            else {
                for(var i = 0; i < constraints.length; i++) {
                    var constraint = constraints[i];

                    delete boundConstraints[group][element.id][ReverseConstraint[constraint]];

                    for(var group in boundConstraints) if(boundConstraints.hasOwnProperty(group)) {
                        removeElementFromGroupIfGroupIsEmpty(id, group);
                    }
                }
            }
        }
    }

    function bind(options) {

        var result = {
            successful: true,
            message: "",
            data: null
        };

        if(typeof options == "undefined" || !options) {
            result = bindAfterParsing();
        }

        else {
            result = bindFromOptions(options);
        }

        if(!result.successful) {
            throw result.message;
        }
            }

    function bindAfterParsing() {
        var elementsWithRegulaValidation = getElementsByClassName("regula-validation", null, null);
        var result = {
            successful: true,
            message: "",
            data: null
        };

        var i = 0;
        while(i < elementsWithRegulaValidation.length && result.successful) {
            var element = elementsWithRegulaValidation[i];
            var tagName = element.tagName.toLowerCase();

            if(tagName != "form" && tagName != "select" && tagName != "textarea" && tagName != "input") {
                result = {
                    successful: false,
                    message: tagName + "#" + element.id + " is not an input, select, or form element! Validation constraints can only be attached to input, select, or form elements.",
                    data: null
                };
            }
            
            // automatically assign an id if the element has not one
            if(!element.id) {
               element.id = "regula-generated-" + Math.floor(Math.random() * 1000000);
            }

            var dataConstraintsAttribute = element.getAttribute("data-constraints");
            result = parse(element, dataConstraintsAttribute);
            i++;
        }

        return result;
    }

    function bindFromOptions(options) {

        var result = {
            successful: true,
            message: "",
            data: null
        };

        var element = options.element;
        var constraints = options.constraints || [];
        var tagName = (element) ? element.tagName.toLowerCase() : null;

        if(!element) {
            result = {
                successful: false,
                message: "regula.bind expects a non-null element attribute in the options argument " + explodeParameters(options),
                data: null
            };
        }

        else if(typeof element != "object") {
            result = {
                successful: false,
                message: "regula.bind: element attribute is of unexpected type: " + typeof element + " " + explodeParameters(options),
                data: null
            };
        }

        else if(constraints.length == 0) {
            result = {
                successful: false,
                message: "regula.bind expects the constraint attribute in the options argument to be a non-empty array of constraint definitions " + explodeParameters(options),
                data: null
            };
        }

        else if(tagName != "form" && tagName != "select" && tagName !="textarea" && tagName !="input") {
            result = {
                successful: false,
                message: tagName + "#" + element.id + " is not an input, select, or form element! Validation constraints can only be attached to input, select, or form elements " + explodeParameters(options),
                data: null
            };
        }

        else {
            var i = 0;
            while(i < constraints.length && result.successful) {
                result = bindFromConstraintDefinition(constraints[i], options);
                i++;
            }
        }

        return result;
    }

    function bindFromConstraintDefinition(constraint, options) {

        //a few inner utility-functions

        //returns union of first and second set
        function union(first, second) {
            var inserted  = {};
            var union = [];

            for(var i = 0; i < first.length; i++) {
                union.push(first[i]);
                inserted[first[i]] =  true;
            }

            for(var j = 0; j < second.length; j++) {
                if(!inserted[second[j]]) {
                    union.push(second[j]);
                }
            }

            return union;
        }

        //substract second set from first
        function subtract(second, first) {
            var difference = [];

            for(var i = 0; i < first.length; i++) {
                if(!exists(second, first[i])) {
                    difference.push(first[i]);
                }
            }

            return difference;
        }

        //handles the overwriting of groups which needs some special logic
        function overwriteGroups(element, constraintType, definedParameters) {
            var oldGroups = boundConstraints[ReverseGroup[Group.Default]][element.id][ReverseConstraint[constraintType]]["groups"].split(/,/);

            var newGroups = [];

            if(definedParameters["groups"]) {
                newGroups = definedParameters["groups"].split(/,/);
            }

            else {
                newGroups.push(ReverseGroup[Group.Default]);
            }

            /* If the list of groups does not contain the "Default" group, let's add it because we don't want to delete it if
               the user did not specify it
             */
            if(!exists(newGroups, ReverseGroup[Group.Default])) {
                newGroups.push(ReverseGroup[Group.Default]);
            }

            var groupsToRemoveConstraintFrom = subtract(newGroups, union(oldGroups, newGroups));

            for(var i = 0; i < groupsToRemoveConstraintFrom.length; i++) {
                var group = groupsToRemoveConstraintFrom[i];

                delete boundConstraints[group][element.id][ReverseConstraint[constraintType]];
                removeElementFromGroupIfGroupIsEmpty(element.id, group);
            }
        }

        var result = {
            successful: true,
            message: "",
            data: null
        };

        var element = options.element;
        var overwriteConstraint = constraint.overwriteConstraint || false;
        var overwriteParameters = constraint.overwriteParameters || false;
        var constraintType = constraint.constraintType;
        var definedParameters = constraint.params || {};
        var newParameters = {__size__: 0};

        /* We check to see if this was a valid/defined constraint. It wasn't so we need to return an error message */
        if(typeof constraintType == "undefined") {
            result = {
                successful: false,
                message: "regula.bind expects a valid constraint type for each constraint in constraints attribute of the options argument. " + explodeParameters(options),
                data: null
            };
        }

        /* we also need to make sure groups make sense (if we got any) */
        else if(definedParameters && definedParameters["groups"]) {

            if(typeof definedParameters["groups"] == "object" && definedParameters["groups"].length != undefined) {

                /* We need to normalize the "groups" parameter that the user sends in. The user sends in the groups parameter as an array of 'enum'
                   values, or if it is a new constraint, a string. We need to normalize this into a string of comma-separated values. While we're
                   doing this, we'll also check to see if we have any invalid groups
                */
                var definedGroups = "";
                var j = 0;

                while(j < definedParameters["groups"].length && result.successful) {

                    if(typeof definedParameters["groups"][j] == "string") {
                        definedGroups += definedParameters["groups"][j] + ","
                    }

                    else if(ReverseGroup[definedParameters["groups"][j]]) {
                        definedGroups += ReverseGroup[definedParameters["groups"][j]] + ","
                    }

                    else {
                        result = {
                            successful: false,
                            message: "Invalid group " + definedParameters["groups"][j] + " " + explodeParameters(options),
                            data: null
                        };
                    }

                    j++;
                }

                if(result.successful) {
                    definedGroups = definedGroups.replace(/,$/, "");
                    definedParameters["groups"] = definedGroups;
                }

            }

            else {
                result = {
                    successful: false,
                    message: "The groups parameter must be an array of enums or strings " + explodeParameters(options),
                    data: null
                };
            }
        }

        if(result.successful) {
            /*
             We check to see if this element-constraint combination does NOT exist. We can say that the combination does NOT exist if
             o The element's id does not exist as a key within the Default group (every element is added to the default group regardless)
             OR IF
             o The element's id exists within the Default group, but this particular constraint has not been bound to it
             If either of these conditions were met, we can simply proceed to validate the constraint definition and then add it if it is valid

             We also have to do one more thing. definedParameters has no '__size__' property. So we need to essentially copy that information
             into newParameters using the put function so that can have a '__size__' property (we will need it when we validate this constraint
             definition)
             */

            if(!boundConstraints[ReverseGroup[Group.Default]][element.id] || !boundConstraints[ReverseGroup[Group.Default]][element.id][ReverseConstraint[constraintType]]) {
                for(var param in definedParameters) if(definedParameters.hasOwnProperty(param)) {
                    put(newParameters, param, definedParameters[param]);
                }

                result = validateConstraintDefinition(element, ReverseConstraint[constraintType], newParameters);
            }

            else {

                if(overwriteConstraint) {
                    /* We are sure that this element-constraint combination exists, and we are sure that we ARE overwriting it. */

                    for(var param in definedParameters) if(definedParameters.hasOwnProperty(param)) {
                        put(newParameters, param, definedParameters[param]);
                    }

                    result = validateConstraintDefinition(element, ReverseConstraint[constraintType], newParameters);

                    if(result.successful) {
                        /* We could delete this element-constraint combination out of all the old groups. But let's be smart about it
                         and only delete it from the groups it no longer exists in (according to the new groups parameter). Since
                         this is a destructive operation we only want to do this if the validation was successful
                         */

                        overwriteGroups(element, constraintType, definedParameters);
                    }
                }

                else {
                    /* We are sure that this element-constraint combination exists, and we are sure that we ARE NOT overwriting it.
                       BUT, we need to check if the overwriteParameter flag is set as well. If that is the case, and the user has
                       specified a parameter that already exists within the parameter list for the constraint, we will overwrite its
                       value with the new one. Otherwise, we will NOT overwrite it and we will maintain the old value
                     */

                    //Let's get the existing parameters for this constraint
                    var oldParameters = boundConstraints[ReverseGroup[Group.Default]][element.id][ReverseConstraint[constraintType]];

                    /* Let's copy our existing parameters into the new parameter map. We'll decide later if we're going to overwrite
                     the existing values or not, based on the overwriteParameter flag
                     */

                    for(var param in oldParameters) if(oldParameters.hasOwnProperty(param)) {
                        put(newParameters, param, oldParameters[param]);
                    }

                    if(overwriteParameters) {
                        //Since overwriteParameter is true, if we find a parameter in definedParameters that already
                        //exists in oldParameters, we'll overwrite the old value with the new one. All this really
                        //entails is iterating over definedParameters and inserting the values into newParameters

                        for(var param in definedParameters) if(definedParameters.hasOwnProperty(param)) {
                            put(newParameters, param, definedParameters[param]);
                        }

                        result = validateConstraintDefinition(element, ReverseConstraint[constraintType], newParameters);

                        if(result.successful) {
                            /* Because we're overwriting, we need to take groups into account. We basically need to see if
                             we need to remove this constraint-element combination from any group(s). For example, assume
                             that we originally had the groups "First" and "Second" and then the user sent in "Second"
                             and "Third". This means that we have to remove this constraint from the "First" group.
                             So basically, the groups we need to remove the element-constraint combination from can be
                             found by performing (Go union Gn) - Gn where Go is the old group set and Gn is the new group
                             set. Since this is a destructive operation, we only want to do it if the constraint definition
                             validated successfully.
                             */
                            overwriteGroups(element, constraintType, newParameters);
                        }
                    }

                    else {
                        //Since overwriteParameter is false, we will only insert a parameter from definedParameters
                        //if it doesn't exist in oldParameters

                        for(var param in definedParameters) if(definedParameters.hasOwnProperty(param)) {
                            if(!oldParameters[param]) {
                                put(newParameters, param, definedParameters[param]);
                            }
                        }
                    }
                }
            }

            if(result.successful) {
                createConstraintFromDefinition(element, ReverseConstraint[constraintType], newParameters);
            }
        }

        return result;
    }

    function validate(options) {
        //generates a key that can be used with the function table to call the correct auxiliary validator function
        //(see below for more details)
        function generateKey(options) {
            var groups = options.groups || null;
            var elementId = options.elementId || null;
            var constraintType = options.constraintType || null;
            var key = "";
            key += (groups == null) ? "0" : "1";
            key += (elementId == null) ? "0" : "1";
            key += (constraintType == null) ? "0" : "1";
            return key;
        }

        //Instead of having a bunch of if-elses, I'm creating a function table that maps the combination of parameters
        //that this function can receive (in its options parameters) to the auxiliary (helper) functions. The key consists
        //of three "bits". The first bit represents whether the options.groups parameter is null (0 for null 1 for not null).
        //The second bit represents whether the options.elementId parameter is null, and the third bit represents whether the
        //options.constraintType parameter is null.
        var functionTable = {
            "000": validateAll,
            "001": validateConstraint,
            "010": validateElement,
            "011": validateElementWithConstraint,
            "100": validateGroups,
            "101": validateGroupsWithConstraint,
            "110": validateGroupsWithElement,
            "111": validateGroupsElementWithConstraint
        };

        validatedConstraints = {}; //clear this out on every run

        //if no arguments were passed in, we initialize options to an empty map
        if(!options) {
            options = {};
        }

        /* default to independent validation for groups i.e., groups are validated independent of each other and will not
           fail early
         */
        if(options.independent == undefined) {
            options.independent = true;
        }

        //Get the actual constraint name
        if(options.constraintType) {
            options.constraintType = ReverseConstraint[options.constraintType];
        }

        //Get the actual group name
        if(options.groups) {
            for(var i = 0; i < options.groups.length; i++) {
                options.groups[i] = ReverseGroup[options.groups[i]];
            }
        }

        return functionTable[generateKey(options)](options);
    }

    function validateAll() {
        var constraintViolations = [];

        for(var group in boundConstraints) if(boundConstraints.hasOwnProperty(group)) {

            var groupElements = boundConstraints[group];

            for(var elementId in groupElements) if(groupElements.hasOwnProperty(elementId)) {

                var elementConstraints = groupElements[elementId];

                for(var elementConstraint in elementConstraints) if(elementConstraints.hasOwnProperty(elementConstraint)) {

                    var constraintViolation = validateGroupElementConstraintCombination(group, elementId, elementConstraint);

                    if(constraintViolation) {
                        constraintViolations.push(constraintViolation);
                    }
                }
            }
        }

        return constraintViolations;
    }

    function validateConstraint(options) {
        var constraintViolations = [];
        var constraintFound = false;

        for(var group in boundConstraints) if(boundConstraints.hasOwnProperty(group)) {

            var groupElements = boundConstraints[group];

            for(var elementId in groupElements) if(groupElements.hasOwnProperty(elementId)) {

                var elementConstraints = groupElements[elementId];

                if(elementConstraints[options.constraintType]) {
                    constraintFound = true;
                    var constraintViolation = validateGroupElementConstraintCombination(group, elementId, options.constraintType);

                    if(constraintViolation) {
                        constraintViolations.push(constraintViolation);
                    }
                }
            }
        }

        //We want to let the user know if they used a constraint that has not been defined anywhere. Otherwise, this
        //function returns zero validation results, which can be (incorrectly) interpreted as a successful validation

        if(!constraintFound) {
            throw "RuleConstraint " + ReverseConstraint[options.constraintType] + " has not been bound to any element. " + explodeParameters(options);
        }

        return constraintViolations;
    }

    function validateElement(options) {
        var constraintViolations = [];
        var elementFound = false;

        for(var group in boundConstraints) if(boundConstraints.hasOwnProperty(group)) {

            var groupElements = boundConstraints[group];

            if(groupElements[options.elementId]) {
                elementFound = true;
                var elementConstraints = groupElements[options.elementId];

                for(var elementConstraint in elementConstraints) if(elementConstraints.hasOwnProperty(elementConstraint)) {

                    var constraintViolation = validateGroupElementConstraintCombination(group, options.elementId, elementConstraint);

                    if(constraintViolation) {
                        constraintViolations.push(constraintViolation);
                    }
                }
            }
        }

        //We want to let the user know if they use an element that does not have any element bound to it. Otherwise, this
        //function returns zero results, which can be (incorrectly) interpreted as a successful validation

        if(!elementFound) {
            throw "No constraints have been bound to element with id " + options.elementId + ". " + explodeParameters(options);
        }

        return constraintViolations;
    }

    function validateElementWithConstraint(options) {
        var constraintViolations = [];
        var elementFound = false;
        var constraintFound = false;

        for(var group in boundConstraints) if(boundConstraints.hasOwnProperty(group)) {

            var groupElements = boundConstraints[group];
            var elementConstraints = groupElements[options.elementId];

            if(elementConstraints) {
                elementFound = true;

                if(elementConstraints[options.constraintType]) {
                    constraintFound = true;

                    var constraintViolation = validateGroupElementConstraintCombination(group, options.elementId, options.constraintType);

                    if(constraintViolation) {
                        constraintViolations.push(constraintViolation);
                    }
                }
            }
        }

        if(!elementFound || !constraintFound) {
            throw "No element with id " + options.elementId + " was found with the constraint " + options.constraintType + " bound to it. " + explodeParameters(options);
        }

        return constraintViolations;
    }

    function validateGroups(options) {
        var constraintViolations = [];

        var i = 0;
        var successful = true;
        while(i < options.groups.length && successful) {
            var group = options.groups[i];

            var groupElements = boundConstraints[group];
            if(groupElements) {

                for(var elementId in groupElements) if(groupElements.hasOwnProperty(elementId)) {

                    var elementConstraints = groupElements[elementId];

                    for(var elementConstraint in elementConstraints) if(elementConstraints.hasOwnProperty(elementConstraint)) {

                        var constraintViolation = validateGroupElementConstraintCombination(group, elementId, elementConstraint);

                        if(constraintViolation) {
                            constraintViolations.push(constraintViolation);
                        }
                    }
                }
            }

            else {
                throw "Undefined group in group list. " + explodeParameters(options);
            }

            i++;
            successful = (constraintViolations.length == 0) || (options.independent && constraintViolations.length != 0);
        }

        return constraintViolations;
    }

    function validateGroupsWithConstraint(options) {
        var constraintViolations = [];

        var i = 0;
        var successful = true;
        while(i < options.groups.length && successful) {
            var group = options.groups[i];

            var groupElements = boundConstraints[group];
            if(groupElements) {
                var constraintFound = false;

                for(var elementId in groupElements) if(groupElements.hasOwnProperty(elementId)) {

                    var elementConstraints = groupElements[elementId];

                    if(elementConstraints[options.constraintType]) {
                        constraintFound = true;
                        var constraintViolation = validateGroupElementConstraintCombination(group, elementId, options.constraintType);

                        if(constraintViolation) {
                            constraintViolations.push(constraintViolation);
                        }
                    }
                }

                //We want to let the user know if they used a constraint that has not been defined anywhere. Otherwise, this
                //function can return zero validation results, which can be (incorrectly) interpreted as a successful validation

                if(!constraintFound) {
                    throw "RuleConstraint " + options.constraintType + " has not been bound to any element under group " + group + ". " + explodeParameters(options);
                }
            }

            else {
                throw "Undefined group in group list. " + explodeParameters(options);
            }

            i++;
            successful = (constraintViolations.length == 0) || (options.independent && constraintViolations.length != 0);
        }

        return constraintViolations;
    }

    function validateGroupsWithElement(options) {
        var constraintViolations = [];
        var notFound = [];

        var i = 0;
        var successful = true;
        while(i < options.groups.length && successful) {
            var group = options.groups[i];

            var groupElements = boundConstraints[group];
            if(groupElements) {

                var elementConstraints = groupElements[options.elementId];

                if(elementConstraints) {
                    for(var elementConstraint in elementConstraints) if(elementConstraints.hasOwnProperty(elementConstraint)) {

                        var constraintViolation = validateGroupElementConstraintCombination(group, options.elementId, elementConstraint);

                        if(constraintViolation) {
                            constraintViolations.push(constraintViolation);
                        }
                    }
                }

                else {
                    notFound.push(group);
                }
            }

            else {
                throw "Undefined group in group list. " + explodeParameters(options);
            }

            i++;
            successful = (constraintViolations.length == 0) || (options.independent && constraintViolations.length != 0);
        }

        if(notFound.length > 0) {
            throw "No element with id " + options.elementId + " was found in the following group(s): [" + explode(notFound, ",").replace(/,/g, ", ") + "]. " + explodeParameters(options);
        }

        return constraintViolations;
    }

    function validateGroupsElementWithConstraint(options) {
        var constraintViolations = [];

        var i = 0;
        var successful = true;
        while(i < options.groups.length && successful) {
            var group = options.groups[i];
            var constraintViolation = validateGroupElementConstraintCombination(group, options.elementId, options.constraintType);

            if(constraintViolation) {
                constraintViolations.push(constraintViolation);
            }

            i++;
            successful = (constraintViolations.length == 0) || (options.independent && constraintViolations.length != 0);
        }

        return constraintViolations;
    }

    function validateGroupElementConstraintCombination(group, elementId, elementConstraint) {
        var constraintViolation;
        var groupElements = boundConstraints[group];

        if(!groupElements) {
            throw "Undefined group in group list";
        }

        var elementConstraints = groupElements[elementId];

        if(!validatedConstraints[elementId]) {
            validatedConstraints[elementId] = {};
        }

        //Validate this constraint only if we haven't already validated it during this validation run
        if(!validatedConstraints[elementId][elementConstraint]) {
            if(!elementConstraints) {
                throw "No constraints have been defined for the element with id: " + elementId + " in group " + group;
            }

            else {
                var params = elementConstraints[elementConstraint];

                if(!params) {
                    throw elementConstraint + " in group " + group + " hasn't been bound to the element with id " + elementId;
                }

                else {
                    var validationResult = runValidatorFor(group, elementId, elementConstraint, params);

                    if(!validationResult.constraintPassed) {
                        var errorMessage = interpolateErrorMessage(elementId, elementConstraint, params);

                        constraintViolation = {
                            group: group,
                            constraintName: elementConstraint,
                            formSpecific: constraintsMap[elementConstraint].formSpecific,
                            custom: constraintsMap[elementConstraint].custom,
                            compound: constraintsMap[elementConstraint].compound,
                            composingConstraintViolations: validationResult.composingConstraintViolations || [],
                            constraintParameters: params,
                            failingElements: validationResult.failingElements,
                            message: errorMessage
                        };
                    }
                }
            }
        }

        return constraintViolation;
    }

    function runValidatorFor(currentGroup, elementId, elementConstraint, params) {
        var constraintPassed = false;
        var failingElements = [];
        var element = document.getElementById(elementId);
        var composingConstraintViolations = [];

        if(constraintsMap[elementConstraint].formSpecific) {
            failingElements = constraintsMap[elementConstraint].validator.call(element, params);
            constraintPassed = failingElements.length == 0;
        }

        else if(constraintsMap[elementConstraint].compound) {
            composingConstraintViolations = constraintsMap[elementConstraint].validator.call(element, params, currentGroup, constraintsMap[elementConstraint]);
            constraintPassed = composingConstraintViolations.length == 0;

            if(!constraintPassed) {
                failingElements.push(element);
            }
        }

        else {
            constraintPassed = constraintsMap[elementConstraint].validator.call(element, params);

            if(!constraintPassed) {
                failingElements.push(element)
            }
        }

        validatedConstraints[elementId][elementConstraint] = true; //mark this element constraint as validated

        var validationResult = {
            constraintPassed : constraintPassed,
            failingElements: failingElements
        };

        if(!constraintsMap[elementConstraint].reportAsSingleViolation) {
            validationResult.composingConstraintViolations = composingConstraintViolations;
        }

        return validationResult;
    }

    function interpolateErrorMessage(elementId, elementConstraint, params) {
        var element = document.getElementById(elementId);
        var errorMessage = "";

        if(params["message"]) {
            errorMessage = params["message"];
        }

        else if(params["msg"]) {
            errorMessage = params["msg"];
        }

        else {
            errorMessage = constraintsMap[elementConstraint].defaultMessage;
        }

        for(var param in params) if(params.hasOwnProperty(param)) {

            var re = new RegExp("{" + param + "}", "g");
            errorMessage = errorMessage.replace(re, params[param]);
        }

        if(/{label}/.test(errorMessage)) {
            var friendlyInputName = friendlyInputNames[element.tagName.toLowerCase()];

            if(!friendlyInputName) {
                friendlyInputName = friendlyInputNames[element.type.toLowerCase()];
            }

            errorMessage = errorMessage.replace(/{label}/, friendlyInputName);
        }

        //not sure if this is just a hack or not. But I'm trying to replace doubly-escaped quotes. This
        //usually happens if the data-constraints attribute is surrounded by double quotes instead of
        //single quotes
        errorMessage = errorMessage.replace(/\\\"/g, "\"");

        return errorMessage;
    }

    return {
        bind: bind,
        unbind: unbind,
        validate: validate,
        custom: custom,
        compound: compound,
        override: override,
        Constraint: Constraint,
        Group: Group,
        DateFormat: DateFormat
    };
})();
    ;Infusion.scriptLoaded('/js/regula/regula.js');
    


/* FILE: /resources/util/url/url.js */
Infusion("Util.Url", function() {
    var ns = Infusion.Util.Url;

    ns.getUrl = getUrl;
    ns.getFullURL = Infusion.getFullURL; // moved to Infusion object as it needed it
    ns.slug = slug;
    
    function getUrl(controller, action, params) {
        if(controller != '' && action != '') {
            var url = "/app/" + controller + "/" + action;

            if(params && params.pathId) {
                url += "/" + params.pathId
                delete params.pathId;
            }
            if(params) {
                url = url + "?"

                var counter = 0;
                for(var i in params) {
                    if(counter != 0) {
                        url = url + '&';
                    }

                    url = url + i + "=" + params[i];
                    counter++;
                }
            }
            
            return url;
        } else {
            return "";
        }
    }

    function slug(input) {
        return input.toLowerCase().replace(/\s+/g, "-").replace(/[^a-z0-9]\-/g, "");
    }

});
    ;Infusion.scriptLoaded('/resources/util/url/url.js');
    


/* FILE: /resources/session/session.js */
Infusion("Session", function() {
    var ns = Infusion.Session;

    ns.continueSession = continueSession;
    ns.initialize = initialize;
    ns.registerActivityListeners = registerActivityListeners;
    ns.updateLastAccessTimeIfNecessary = updateLastAccessTimeIfNecessary;
    ns.handlingTimeouts = handlingTimeouts;

    var canBeFocused = true;

    var originalWindowTitle;
    var targetDocumentForTitle;

    var isLastAccessedWindow;

    var handlingTimeouts;

    /**
     * Local variable that stores the last time this window had activity
     */
    var lastAccessTime = 0;

    /**
     * How long the warn pop up will stay for
     */
    var popUpCountdown = 90;

    var timeout;
    var warn;

    /**
     * Reference to the timeout object that manually logs the user out.  Used for cancelling the timer
     */
    var manualLogoutTimeoutObj;

    /**
     * Reference to the timeout object that pops up the warning lightbox.
     */
    var popupTimeoutObj;

    /**
     * Stateful var that tells whether or not to listen to user activity.  Is turned off
     * while the pop up is present.
     */
    var listenForEvents = true;

    /**
     * Does four things:
     *
     * Starts the timer that pops up the session timeout window
     * Starts the timer that polls for new activity ever x seconds
     * Starts a looping call to keep the server alive every ten minutes
     * Starts a looping call that will sync the cookie every minute
     * Registers listeners for user activity
     */
    function initialize() {
        try {
            handlingTimeouts = !isParentHandlingTimeouts();
            originalWindowTitle = window.top.document.title;
            targetDocumentForTitle = window.top.document;
        } catch(e) {
            handlingTimeouts = true;
            originalWindowTitle = document.title;
            targetDocumentForTitle = document;
        }

//        console.debug("Am I handling timeouts? " + handlingTimeouts);

        waitForTimeout();
        keepSessionAlive();
        updateLastAccessTime();

        syncCookie();
        registerActivityListeners(document);
    }

    /**
     * This function will inspect parents looking for another window that's already handling the timeouts.
     */
    function isParentHandlingTimeouts() {
        var currWindow = window;
        var foundAnotherHandler = false;

        while (currWindow != currWindow.parent) {
            if (Infusion.has("Infusion.Session.handlingTimeouts"),currWindow.parent) {

                foundAnotherHandler = true;
                break;
            }
            currWindow = currWindow.parent;
        }
        return foundAnotherHandler;
    }

    /**
     * Actually pops up the session timeout warning screen.  Also starts the
     * timeout to perform manual log out
     */
    function warnSession() {
        //Final check prior to popping up window.
        if (!checkForNewActivity()) {
            if (isLastAccessedWindow) {
                window.focus();
            }
            listenForEvents = false; //Don't listen for scroll or clicks while the box is popped up
            if (jQuery("frameset").length == 0) {
                warn = Infusion.Popup.popLightbox("Session Timeout Warning",
                        Infusion.Url.getViewUrl("session", "sessionTimeoutNotification"),
                {width: "300", height: "200", startcentered:true});
            } else {
//                console.log("I'm a frameset, not popping up timeout window");
            }
            if (manualLogoutTimeoutObj) {
                clearTimeout(manualLogoutTimeoutObj);
            }
            updateTitleCountdown();
        }
    }

    function updateTitleCountdown() {
        if (popUpCountdown > 0) {
            targetDocumentForTitle.title = "Logout in " + popUpCountdown + " seconds";
            popUpCountdown--;
            manualLogoutTimeoutObj = setTimeout(updateTitleCountdown, 1000);
        } else {
            killSession();
        }
    }

    /**
     * Method that actually performs the manual log out.  Is called if the warning window is present for 90 seconds
     * without being clicked by the user
     */
    function killSession() {
        if (!checkForNewActivity()) {

            //Only kill the session if the warn window is still present (fail safe)
            if (warn) {
                window.location = '/j_spring_security_logout?timeout=true';
            }
        }
    }

    /**
     * This method is called when the user cancels the pop-up timeout window.  A call to the server
     * will reset the last accessed flag so other windows can pick up the change.
     */
    function continueSession() {
        listenForEvents = true;
        updateLastAccessTime();
        pingServer();
        resetTimers();
    }

    /**
     * An internal method used to reset internal timers:
     *
     * Cancels the timer that pops up the session timeout window
     * Cancels The timer that forces a logout after the timeout window appears (if exists)
     *
     * Restarts the timer that pops up the timeout window
     */
    function resetTimers() {
        if (popupTimeoutObj) {
            clearTimeout(popupTimeoutObj);
            popupTimeoutObj = null;
        }

        //Clear timeout so it won't try to kill your session
        if (manualLogoutTimeoutObj) {
            clearTimeout(manualLogoutTimeoutObj);
            manualLogoutTimeoutObj = null;
        }

        popUpCountdown = 90;
        targetDocumentForTitle.title = originalWindowTitle;

        //Close the lightbox
        if (warn) {
            Infusion.Popup.closeLightBox(warn);
        }

        //Start listening again for timeout
        waitForTimeout();
        listenForEvents = true;
    }

    function pingServer() {
        //Ajax ping the server to restart
        jQuery.ajax({cache:false, url:Infusion.Url.getViewUrl("session", "keepAlive")});
    }

    /**
     * Listens for activity on the server (also listens to other tabs).  When the function completes, it will set a timer
     * to call the function again in 3 seconds
     */
    function keepSessionAlive() {
        if (handlingTimeouts) {

            //Every minute, check for activity on server.  If activity is found, clear session timeout
            pingServer();

            //Check again for activity
            var tenMinutes = 1000 * 60 * 60 * 10;
            setTimeout(keepSessionAlive, tenMinutes);
        }
    }

    /**
     * Looping call to sync up the cookie every 60 seconds, but only if our last access time is greater than the
     * last access time in the cookie.
     */
    function syncCookie() {
        var lastAccessTimeCookie = parseInt(jQuery.cookie("lastAccessTime"));
        if (!lastAccessTimeCookie) {
            lastAccessTimeCookie = 0;
        }

        if (lastAccessTime > lastAccessTimeCookie) {
            isLastAccessedWindow = canBeFocused;
//            console.debug("I was newer by " + (lastAccessTime - lastAccessTimeCookie));
            jQuery.cookie("lastAccessTime", lastAccessTime, {path:"/", secure:true});
        } else if (lastAccessTime < lastAccessTimeCookie) {
            isLastAccessedWindow = false;
//            console.debug("Cookie was newer by " + (lastAccessTimeCookie - lastAccessTime));
            lastAccessTime = lastAccessTimeCookie;
            resetTimers();
        } else {
//            console.debug("There was no change - I'm idle " + lastAccessTime)
        }
        setTimeout(syncCookie, 6000);
    }

    function updateLastAccessTime() {
        if (listenForEvents) {
            lastAccessTime = new Date().getTime();
        } else {
//            console.debug("Not listening for events - ignoring")
        }
    }

    /**
     * Determines if there's been any activity in the last x milliseconds (in any window)
     */
    function checkForNewActivity() {
        var inLastXMillis = getSessionWarnTimeout();
        var hasNewAccessTime = false;
        var lastAccessTimeCookie = parseInt(jQuery.cookie("lastAccessTime"));
        if (lastAccessTimeCookie > lastAccessTime) {
//            console.debug("Found a newer last access from cookie: " + lastAccessTimeCookie);
            lastAccessTime = lastAccessTimeCookie;
        }
        if (lastAccessTime + inLastXMillis > new Date().getTime()) {
//            console.debug("Has had activity in the last " + (inLastXMillis / 1000));
            hasNewAccessTime = true;
            resetTimers();
        } else {
//            console.debug("No activity detected in " + (inLastXMillis / 1000) + " - continuing")
        }

        return hasNewAccessTime;
    }

    /**
     * For testing, it is helpful to force this function to return 10 * 1000 (10 seconds)
     * Just be sure not to commit it that way ;)
     */
    function getSessionWarnTimeout() {
        return sessionTimeoutLength * 1000 - 90000;
    }

    /**
     * Starts a timer that pops up the session timeout window after the specified timeout period.
     */
    function waitForTimeout() {
        if (handlingTimeouts) {
            var tMinus90Seconds = getSessionWarnTimeout();
            var waitDifference = getWaitDifference(tMinus90Seconds);

            warn = null;
            manualLogoutTimeoutObj = null;
            if (popupTimeoutObj) {
//                console.debug("Found an existing session timeout warn when scheduling a new one");
                clearTimeout(popupTimeoutObj)
            }
//            console.debug("Pop up session timeout warn in " + (waitDifference / 1000) + " secs");
            popupTimeoutObj = setTimeout(warnSession, waitDifference);
        }
    }

    /**
     * Gets the difference between the last activity on the server and the time you are trying to wait.  For example,
     * I want to wait 90 seconds from last activity, and 24 seconds have already elapsed, so I need to wait for an
     * additional 66 seconds.
     * @param shouldWaitFor
     */
    function getWaitDifference(shouldWaitFor) {
        var rtn;
        if (lastAccessTime == 0) {
            rtn = shouldWaitFor;
        } else {
            var currTime = new Date().getTime();
            var elapsedTime = currTime - lastAccessTime;
            rtn = shouldWaitFor - elapsedTime
        }
        return rtn;
    }

    function registerActivityListeners(what) {
        var events = 'keydown DOMMouseScroll mousewheel mousedown';
        jQuery(what).bind(events, updateLastAccessTime);
    }

    function updateLastAccessTimeIfNecessary(event) {
        if (event == 'keydown' || event == 'DOMMouseScroll' || event == 'mousewheel' || event == 'mousedown') {
            updateLastAccessTime();
        }
    }

}, {js:["Util.Url", "Popup"]});
    ;Infusion.scriptLoaded('/resources/session/session.js');
    


/* FILE: /resources/util/navigation/navigation.js */
Infusion("Util.Navigation", function() {
    var ns = Infusion.Util.Navigation;

    ns.navigate = navigate;

    function navigate(url, confirmMsg) {
        if(confirmMsg && confirmMsg != '') {
            if(confirm(confirmMsg)) {
                window.location = url;
            }
        } else {
            window.location = url;
        }
    }



});
    ;Infusion.scriptLoaded('/resources/util/navigation/navigation.js');
    


/* FILE: /resources/external/bootstrap/v1.4.0/bootstrap-dropdown.js */
/* ============================================================
 * bootstrap-dropdown.js v1.4.0
 * http://twitter.github.com/bootstrap/javascript.html#dropdown
 * ============================================================
 * Copyright 2011 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================ */


!function( $ ){

  "use strict"

  /* DROPDOWN PLUGIN DEFINITION
   * ========================== */

  $.fn.dropdown = function ( selector ) {
    return this.each(function () {
      $(this).delegate(selector || d, 'click', function (e) {
        var li = $(this).parent()
          , isActive = li.hasClass('open')

        clearMenus()
        !isActive && li.toggleClass('open')
        return false
      })
    })
  }

  /* APPLY TO STANDARD DROPDOWN ELEMENTS
   * =================================== */

  var d = 'a.menu, .dropdown-toggle'

  function clearMenus() {
    $(d).parent().removeClass('open')
  }

  $(function () {
    $('html').bind("click", clearMenus);
    $('body').dropdown( '[data-dropdown] a.menu, [data-dropdown] .dropdown-toggle' );
  })

}( window.jQuery || window.ender );

    ;Infusion.scriptLoaded('/resources/external/bootstrap/v1.4.0/bootstrap-dropdown.js');
    


/* FILE: /resources/util/bootstrap/bootstrapext.js */
Infusion("Util.BootstrapExt", function() {

    jQuery(document).ready(init);
    jQuery(document).bind("ajaxFill", init);

    function init (e, fill) {
        fill = fill || document;
        jQuery("table[height='100%']", fill).attr("height", "");

        jQuery("#main-table", fill).addClass("layout");
        jQuery("table.tab", fill).addClass("layout");

        jQuery("input[type='submit'][name='add'], input[type='submit'][name='Add']", fill).addClass("primary");
        jQuery("input[type='submit'][name='save'], input[type='submit'][name='Save']", fill).addClass("primary");

        jQuery(".tabs,.pills", fill).tabs().bind("change", function(e) {
            var $target = jQuery(e.target);
            var $relatedTarget = jQuery(e.relatedTarget);

            var url = $target.attr("data-url");
            if(url && !$target.attr("data-tab-loaded")) {
                var targetId = $target.attr("href").substring(1);
                jQuery("[id='"+targetId+"']").load(url);
                $target.attr("data-tab-loaded", "true");
            }
        });

        jQuery(".tabs li,.pills li", fill).each(function() {
            if(jQuery(this).hasClass("active")) {
                var targetId = jQuery(this).find("a").attr("href").substring(1);
                jQuery("[id='" + targetId + "']").addClass("active");
            }

        })
    }

});


    ;Infusion.scriptLoaded('/resources/util/bootstrap/bootstrapext.js');
    
