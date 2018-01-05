<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:survey/Resources/Private/Language/locallang_db.xlf:tx_survey_domain_model_survey',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,description,postdate,organizername,deadline,visible,comment_visible,organizer,appiontments,comments,subscribers,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('survey') . 'Resources/Public/Icons/tx_survey_domain_model_survey.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, description, postdate, organizername, deadline, visible, comment_visible, organizer, appiontments, comments, subscribers',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, description, postdate, organizername, deadline, visible, comment_visible, organizer, appiontments, comments, subscribers, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_survey_domain_model_survey',
				'foreign_table_where' => 'AND tx_survey_domain_model_survey.pid=###CURRENT_PID### AND tx_survey_domain_model_survey.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:survey/Resources/Private/Language/locallang_db.xlf:tx_survey_domain_model_survey.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:survey/Resources/Private/Language/locallang_db.xlf:tx_survey_domain_model_survey.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'postdate' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:survey/Resources/Private/Language/locallang_db.xlf:tx_survey_domain_model_survey.postdate',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => '0000-00-00 00:00:00'
			),
		),
		'organizername' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:survey/Resources/Private/Language/locallang_db.xlf:tx_survey_domain_model_survey.organizername',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'deadline' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:survey/Resources/Private/Language/locallang_db.xlf:tx_survey_domain_model_survey.deadline',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => '0000-00-00 00:00:00'
			),
		),
		'visible' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:survey/Resources/Private/Language/locallang_db.xlf:tx_survey_domain_model_survey.visible',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'comment_visible' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:survey/Resources/Private/Language/locallang_db.xlf:tx_survey_domain_model_survey.comment_visible',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'organizer' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:survey/Resources/Private/Language/locallang_db.xlf:tx_survey_domain_model_survey.organizer',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'fe_users',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'appiontments' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:survey/Resources/Private/Language/locallang_db.xlf:tx_survey_domain_model_survey.appiontments',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_survey_domain_model_appiontment',
				'foreign_field' => 'survey',
				'foreign_sortby' => 'appiontmentdate',
				'maxitems' => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),

		),
		'comments' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:survey/Resources/Private/Language/locallang_db.xlf:tx_survey_domain_model_survey.comments',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_survey_domain_model_comment',
				'foreign_field' => 'survey',
				'maxitems' => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),

		),
		'subscribers' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:survey/Resources/Private/Language/locallang_db.xlf:tx_survey_domain_model_survey.subscribers',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_survey_domain_model_subscriber',
				'foreign_field' => 'survey',
				'maxitems' => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),

		),
		
	),
);