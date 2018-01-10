<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Schmidtch.' . $_EXTKEY,
	'Surveylisting',
	array(
		'Survey' => 'list, addFormTitle, addFormDate, add, show, updateForm, update, deleteConfirm, delete',
		'Appiontment' => 'list,addFormDate,addFormTime, add, ajaxAdd, show, updateForm, updateFormAppiontment, update, deleteConfirm, delete',
		'TimeOfDay' => 'list,addFormTime, add, ajaxAdd, show, updateForm, update, deleteConfirm, delete, deleteUpdateSurvey, deleteUpdateAppiontment, deleteAddAppiontment',
		'Subscriber' => 'list, add, addForm, show, showAfter, updateForm, update, deleteConfirm, delete, register, registerForm,, commentAjax',
		'Comment' => 'delete',
	),
	// non-cacheable actions
	array(
		'Survey' => 'list, addFormTitle, addFormDate, add, show, updateForm, update, deleteConfirm, delete',
		'Appiontment' => 'list, addFormDate,addFormTime, add, ajaxAdd, show, updateForm, updateFormAppiontment, update, deleteConfirm, delete',
		'TimeOfDay' => 'list,addFormTime, add, ajaxAdd, show, updateForm, update, deleteConfirm, delete, deleteUpdateSurvey, deleteUpdateAppiontment, deleteAddAppiontment',
		'Subscriber' => 'list, add, addForm, show, showAfter, updateForm, update, deleteConfirm, delete, register, registerForm, commentAjax',
		'Comment' => 'delete',
	)
);
