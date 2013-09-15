// FCKeditor configuration
parent._wrs_conf_usePopUps = true;
parent._wrs_conf_editorWidth = 500;
parent._wrs_conf_editorHeight = 500;
parent._wrs_conf_CASWidth = 640;
parent._wrs_conf_CASHeight = 580;

// Including core.js
var script = parent.document.createElement('script');
script.type = 'text/javascript';
script.src = FCKConfig.PluginsPath + 'fckeditor_wiris/core/core.js';
parent.document.getElementsByTagName('head')[0].appendChild(script);

// Configuration
parent._wrs_conf_editorEnabled = true;		// Specifies if fomula editor is enabled
parent._wrs_conf_CASEnabled = true;		// Specifies if WIRIS cas is enabled

parent._wrs_conf_imageMathmlAttribute = 'data-mathml';	// Specifies the image tag where we should save the formula editor mathml code
parent._wrs_conf_CASMathmlAttribute = 'alt';	// Specifies the image tag where we should save the WIRIS cas mathml code

parent._wrs_conf_editorPath = FCKConfig.PluginsPath + 'fckeditor_wiris/integration/editor.php';			// Specifies where is the editor HTML code (for popup window)
parent._wrs_conf_editorAttributes = 'width=570, height=450, scroll=no, resizable=yes';							// Specifies formula editor window options.
parent._wrs_conf_CASPath = FCKConfig.PluginsPath + 'fckeditor_wiris/integration/cas.php';					// Specifies where is the WIRIS cas HTML code (for popup window)
parent._wrs_conf_CASAttributes = 'width=640, height=480, scroll=no, resizable=yes';						// Specifies WIRIS cas window options

parent._wrs_conf_createimagePath = FCKConfig.PluginsPath + 'fckeditor_wiris/integration/createimage.php';			// Specifies where is createimage script
parent._wrs_conf_createcasimagePath = FCKConfig.PluginsPath + 'fckeditor_wiris/integration/createcasimage.php';		// Specifies where is createcasimage script

parent._wrs_conf_getmathmlPath = FCKConfig.PluginsPath + 'fckeditor_wiris/integration/getmathml.php';				// Specifies where is the getmathml script
parent._wrs_conf_servicePath = FCKConfig.PluginsPath + 'fckeditor_wiris/integration/service.php';					// Specifies where is the service script

parent._wrs_conf_saveMode = 'tags';					// this value can be 'tags', 'xml' or 'safeXml'.
parent._wrs_conf_parseModes = ['latex'];				// This value can contain 'latex'.

parent._wrs_conf_useDigestInsteadOfMathml = false;
//parent._wrs_conf_digestPostVariable = 'digest';

parent._wrs_conf_enableAccessibility = true;

// Vars
parent._wrs_int_editorIcon = FCKConfig.PluginsPath + 'fckeditor_wiris/core/icons/formula.gif';
parent._wrs_int_CASIcon = FCKConfig.PluginsPath + 'fckeditor_wiris/core/icons/cas.gif';
parent._wrs_int_temporalIframe;
parent._wrs_int_temporalImageResizing;
parent._wrs_int_wirisProperties;
parent._wrs_int_window;
parent._wrs_int_window_opened = false;
parent._wrs_int_directionality;

// Plugin integration

function whenDocReady(editorInstance, status) {
	if (status == FCK_STATUS_COMPLETE) {
		if (parent.wrs_initParse) {
			//SetData removes all the event listeners.
			//changed to innerHTML because of a bug in Chamilo
			//editorInstance.SetData(parent.wrs_initParse(editorInstance.GetData()));
			editorInstance.EditorDocument.body.innerHTML = parent.wrs_initParse(editorInstance.GetData());
			parent.wrs_addIframeEvents(editorInstance.EditingArea.IFrame, null, wrs_int_mousedownHandler, wrs_int_mouseupHandler);
		}
		else {
			setTimeout(function () {
				whenDocReady(editorInstance, status);
			}, 50);
		}
	}
}

FCK.Events.AttachEvent('OnStatusChange', whenDocReady);

FCK.Events.AttachEvent('OnAfterLinkedFieldUpdate', function (editorInstance) {
	var form = editorInstance.GetParentForm();
	form[editorInstance.Name].value = parent.wrs_endParse(form[editorInstance.Name].value);
});

// FCKeditor disables WIRIS double click handlers. Using this method, we can handle it.
FCK.RegisterDoubleClickHandler(function (element) {
	wrs_int_doubleClickHandler(parent._wrs_int_temporalIframe, element);
}, 'IMG');

if (parent._wrs_conf_editorEnabled) {
	var WIRISFormulaCommand = function () {
	}

	parent._wrs_int_directionality = FCK.Config['ContentLangDirection'];
	
	WIRISFormulaCommand.prototype = new FCKUndefinedCommand();

	WIRISFormulaCommand.prototype.Execute = function () {
		parent._wrs_int_wirisProperties = {};
		
		if ('wirisimagecolor' in FCK.Config) {
			parent._wrs_int_wirisProperties['color'] = FCK.Config['wirisimagecolor'];
		}

		if ('wirisimagebgcolor' in FCK.Config) {
			parent._wrs_int_wirisProperties['bgColor'] = FCK.Config['wirisimagebgcolor'];
		}

		if ('wirisimagebackgroundcolor' in FCK.Config) {
			parent._wrs_int_wirisProperties['backgroundColor'] = FCK.Config['wirisimagebackgroundcolor'];
		}
		
		if ('wirisimagesymbolcolor' in FCK.Config) {
			parent._wrs_int_wirisProperties['symbolColor'] = FCK.Config['wirisimagesymbolcolor'];
		}

		if ('wirisimagenumbercolor' in FCK.Config) {
			parent._wrs_int_wirisProperties['numberColor'] = FCK.Config['wirisimagenumbercolor'];
		}
		
		if ('wirisimageidentcolor' in FCK.Config) {
			parent._wrs_int_wirisProperties['identColor'] = FCK.Config['wirisimageidentcolor'];
		}
		
		if ('wiristransparency' in FCK.Config) {
			parent._wrs_int_wirisProperties['transparency'] = FCK.Config['wiristransparency'];
		}
		
		if ('wirisimagefontsize' in FCK.Config) {
			parent._wrs_int_wirisProperties['fontSize'] = FCK.Config['wirisimagefontsize'];
		}
		
		if ('wirisdpi' in FCK.Config) {
			parent._wrs_int_wirisProperties['dpi'] = FCK.Config['wirisdpi'];
		}
		
		wrs_int_openNewFormulaEditor(FCK.EditingArea.IFrame, FCK.Language.GetActiveLanguage());
	}
		
	FCKCommands.RegisterCommand(
		'fckeditor_wiris_openFormulaEditor',
		new WIRISFormulaCommand()
	);
	
	FCKCommands.RegisterCommand(
		'fckeditor_wiris_openFormulaEditor_aux',
		new FCKDialogCommand(
			'WIRIS editor',
			'WIRIS editor',
			parent._wrs_conf_editorPath,
			500,
			400
		)
	);
	
	var formulaItem = new FCKToolbarButton('fckeditor_wiris_openFormulaEditor', 'WIRIS editor');
	formulaItem.IconPath = parent._wrs_int_editorIcon;

	FCKToolbarItems.RegisterItem(
		'fckeditor_wiris_openFormulaEditor',
		formulaItem
	);
}

if (parent._wrs_conf_CASEnabled) {
	var WIRISCASCommand = function () {
	}

	WIRISCASCommand.prototype = new FCKUndefinedCommand();

	WIRISCASCommand.prototype.Execute = function () {
		wrs_int_openNewCAS(FCK.EditingArea.IFrame, FCK.Language.GetActiveLanguage());
	}

	FCKCommands.RegisterCommand(
		'fckeditor_wiris_openCAS',
		new WIRISCASCommand()
	);

	var casItem = new FCKToolbarButton('fckeditor_wiris_openCAS', 'WIRIS cas');
	casItem.IconPath = parent._wrs_int_CASIcon;

	FCKToolbarItems.RegisterItem(
		'fckeditor_wiris_openCAS',
		casItem
	);
}

/**
 * Opens formula editor.
 * @param object iframe Target
 */
function wrs_int_openNewFormulaEditor(iframe, language) {
	parent._wrs_isNewElement = true;
	parent._wrs_int_temporalIframe = iframe;
	
	if (parent._wrs_conf_usePopUps) {
		if (parent._wrs_int_window_opened) {
			parent._wrs_int_window.focus();
		}
		else {
			parent._wrs_int_window_opened = true;
			parent._wrs_int_window = parent.wrs_openEditorWindow(language, iframe, true);
		}
	}
	else {
		FCKDialog.OpenDialog('WIRIS editor', 'WIRIS editor', parent._wrs_conf_editorPath, parent._wrs_conf_editorWidth, parent._wrs_conf_editorHeight);
		wrs_int_hidePopUpButtons();
	}
}

/**
 * Opens CAS.
 * @param object iframe Target
 */
function wrs_int_openNewCAS(iframe, language) {
	parent._wrs_isNewElement = true;
	parent._wrs_int_temporalIframe = iframe;
	
	if (parent._wrs_conf_usePopUps) {
		if (parent._wrs_int_window_opened) {
			parent._wrs_int_window.focus();
		}
		else {
			parent._wrs_int_window_opened = true;
			parent._wrs_int_window = parent.wrs_openCASWindow(iframe, true, language);
		}
	}
	else {
		FCKDialog.OpenDialog('WIRIS cas', 'WIRIS cas', parent._wrs_conf_CASPath, parent._wrs_conf_CASWidth, parent._wrs_conf_CASHeight);
		wrs_int_hidePopUpButtons();
	}
}

/**
 * Handles a double click on the iframe.
 * @param object iframe Target
 * @param object element Element double clicked
 */
function wrs_int_doubleClickHandler(iframe, element) {
	if (element.nodeName.toLowerCase() == 'img') {
		if (parent.wrs_containsClass(element, 'Wirisformula')) {
			if (!parent._wrs_int_window_opened) {
				parent._wrs_int_wirisProperties = {
					'bgColor': FCK.Config['wirisimagebgcolor'],
					'symbolColor': FCK.Config['wirisimagesymbolcolor'],
					'transparency': FCK.Config['wiristransparency'],
					'fontSize': FCK.Config['wirisimagefontsize'],
					'numberColor': FCK.Config['wirisimagenumbercolor'],
					'identColor': FCK.Config['wirisimageidentcolor'],
					'color' : FCK.Config['wirisimagecolor'],
					'dpi' : FCK.Config['wirisdpi'],
					'backgroundColor' : FCK.Config['wirisimagebackgroundcolor'],
					'fontFamily' : FCK.Config['wirisfontfamily']
				};
				
				parent._wrs_temporalImage = element;
				wrs_int_openExistingFormulaEditor(iframe, FCK.Language.GetActiveLanguage());
			}
			else {
				parent._wrs_int_window.focus();
			}
		}
		else if (parent.wrs_containsClass(element, 'Wiriscas')) {
			if (!parent._wrs_int_window_opened) {
				parent._wrs_temporalImage = element;
				wrs_int_openExistingCAS(iframe, FCK.Language.GetActiveLanguage());
			}
			else {
				parent._wrs_int_window.focus();
			}
		}
	}
}

/**
 * Opens formula editor to edit an existing formula.
 * @param object iframe Target
 */
function wrs_int_openExistingFormulaEditor(iframe, language) {
	parent._wrs_isNewElement = false;
	parent._wrs_int_temporalIframe = iframe;
	
	if (parent._wrs_conf_usePopUps) {
		parent._wrs_int_window_opened = true;
		parent._wrs_int_window = parent.wrs_openEditorWindow(language, iframe, true);
	}
	else {
		FCKDialog.OpenDialog('WIRIS editor', 'WIRIS editor', parent._wrs_conf_editorPath, parent._wrs_conf_editorWidth, parent._wrs_conf_editorHeight);	
		wrs_int_hidePopUpButtons();
	}
}

/**
 * Opens CAS to edit an existing formula.
 * @param object iframe Target
 */
function wrs_int_openExistingCAS(iframe, language) {
	parent._wrs_isNewElement = false;
	parent._wrs_int_temporalIframe = iframe;
	
	if (parent._wrs_conf_usePopUps) {
		parent._wrs_int_window_opened = true;
		parent._wrs_int_window = parent.wrs_openCASWindow(iframe, true, language);
	}
	else {
		FCKDialog.OpenDialog('WIRIS cas', 'WIRIS cas', parent._wrs_conf_CASPath, parent._wrs_conf_CASWidth, parent._wrs_conf_CASHeight);
		wrs_int_hidePopUpButtons();
	}
}

/**
 * Handles a mouse down event on the iframe.
 * @param object iframe Target
 * @param object element Element mouse downed
 */
function wrs_int_mousedownHandler(iframe, element) {
	parent._wrs_int_temporalIframe = iframe;	// This allows to recognize de iframe for double click events.
	
	if (element.nodeName.toLowerCase() == 'img') {
		if (parent.wrs_containsClass(element, 'Wirisformula') || parent.wrs_containsClass(element, 'Wiriscas')) {
			parent._wrs_int_temporalImageResizing = element;
		}
	}
}

/**
 * Handles a mouse up event on the iframe.
 */
function wrs_int_mouseupHandler() {
	if (parent._wrs_int_temporalImageResizing) {
		setTimeout(function () {
			parent._wrs_int_temporalImageResizing.removeAttribute('style');
			parent._wrs_int_temporalImageResizing.removeAttribute('width');
			parent._wrs_int_temporalImageResizing.removeAttribute('height');
		}, 10);
	}
}

/**
 * Calls wrs_updateFormula with well params.
 * @param string mathml
 */
parent.wrs_int_updateFormula = function (mathml, editMode, language) {								// We need instance this function on parent object because core/editor.js only can access to the parent object.
	parent.wrs_updateFormula(parent._wrs_int_temporalIframe.contentWindow, parent._wrs_int_temporalIframe.contentWindow, mathml, parent._wrs_int_wirisProperties, editMode, language);
}

/**
 * Calls wrs_updateCAS with well params.
 * @param string appletCode
 * @param string image
 * @param int width
 * @param int height
 */
parent.wrs_int_updateCAS = function (appletCode, image, width, height) {		// We need instance this function on parent object because core/cas.js only can access to the parent object.
	parent.wrs_updateCAS(parent._wrs_int_temporalIframe.contentWindow, parent._wrs_int_temporalIframe.contentWindow, appletCode, image, width, height);
}

/**
 * Handles window closing.
 */
parent.wrs_int_notifyWindowClosed = function () {								// We need instance this function on parent object because core/editor.js only can access to the parent object.
	parent._wrs_int_window_opened = false;
}

/*
 * Hiddes popup buttons.
 */
function wrs_int_hidePopUpButtons() {
	var cover = FCKDialog.GetCover();
	
	if (cover) {
		function hideCancelButton() {
			var button = cover.nextSibling.contentWindow.document.getElementById('btnCancel');
			
			if (button) {
				//button.style.visibility = 'hidden';				// It runs on Firefox, but on IE it causes an unknown error. The ugly solution above works well:
				button.style.position = 'absolute';
				button.style.top = '1000px';
			}
			else {
				setTimeout(hideCancelButton, 50);
			}
		}
		
		hideCancelButton();
	}
}
