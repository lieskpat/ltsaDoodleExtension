<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Schmidtch.' . $_EXTKEY,
	'Surveylisting',
	array(
		'Survey' => 'addFormTitle, add, addFormDate, list, show, updateForm, update, deleteConfirm, delete',
		'Appointment' => 'list,addFormDate,addFormTime, add, ajaxAdd, show, updateForm, updateFormAppointment, update, deleteConfirm, delete',
		'TimeOfDay' => 'list,addFormTime, add, ajaxAdd, show, updateForm, update, deleteConfirm, delete, deleteUpdateSurvey, deleteUpdateAppointment, deleteAddAppointment',
		'Subscriber' => 'list, add, addForm, show, showAfter, updateForm, update, deleteConfirm, delete, register, registerForm,, commentAjax',
		'Comment' => 'delete',
	),
	// non-cacheable actions
	array(
		'Survey' => 'addFormTitle, add, addFormDate, list, show, updateForm, update, deleteConfirm, delete',
		'Appointment' => 'list, addFormDate,addFormTime, add, ajaxAdd, show, updateForm, updateFormAppointment, update, deleteConfirm, delete',
		'TimeOfDay' => 'list,addFormTime, add, ajaxAdd, show, updateForm, update, deleteConfirm, delete, deleteUpdateSurvey, deleteUpdateAppointment, deleteAddAppointment',
		'Subscriber' => 'list, add, addForm, show, showAfter, updateForm, update, deleteConfirm, delete, register, registerForm, commentAjax',
		'Comment' => 'delete',
	)
);
