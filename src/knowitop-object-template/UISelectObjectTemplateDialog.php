<?php

class UISelectObjectTemplateDialog
{
	/** @var \DBSearch $oFilter */
	private $oFilter;
	/** @var string $sId */
	private $sId;
	/** @var string $sSelectionMode */
	private $sSelectionMode;

	public function __construct(DBSearch $oFilter, string $sId = 'UISelectObjectTemplateDialog', string $sSelectionMode = 'single')
	{
		$this->oFilter = $oFilter;
		$this->sId = $sId;
		$this->sSelectionMode = $sSelectionMode;
	}

	public function GetSearchTemplateDlg(WebPage $oPage): string
	{
		$oBlock = new DisplayBlock($this->oFilter, 'search', false);
		$sHtml = '<div class="wizContainer" style="vertical-align:top;"><div>';
		$sHtml .= $oBlock->GetDisplay($oPage, 'SearchFormToSelect_'.$this->sId, [
			'menu' => false,
			'result_list_outer_selector' => "SearchResultsToSelect_{$this->sId}",
			'table_id' => "select_{$this->sId}",
			'table_inner_id' => "ResultsToSelect_{$this->sId}",
			'selection_mode' => true,
			'selection_type' => $this->sSelectionMode,
			'cssCount' => "#count_{$this->sId}",
			'query_params' => $this->oFilter->GetInternalParams(),
		]);
		$sHtml .= "<form id=\"SelectTemplateForm_{$this->sId}\" onsubmit=\"return false;\">";
		$sHtml .= "<div id=\"SearchResultsToSelect_{$this->sId}\" style=\"vertical-align:top;background: #fff;height:100%;overflow:auto;padding:0;border:0;\">";
		$sHtml .= "<div style=\"background: #fff; border:0; text-align:center; vertical-align:middle;\"><p>".Dict::S('UI:Message:EmptyList:UseSearchForm')."</p></div>";
		$sHtml .= "</div>";
		$sHtml .= "<button type=\"button\" id=\"button_cancel_{$this->sId}\">".Dict::S('UI:Button:Cancel')."</button>";
		$sHtml .= "&nbsp;&nbsp;";
		$sHtml .= "<button type=\"submit\" id=\"button_submit_{$this->sId}\">".Dict::S('UI:Button:Add')."</button>";
		$sHtml .= "<input type=\"hidden\" id=\"count_{$this->sId}\" value=\"0\">";
		$sHtml .= "</form>";
		$sHtml .= '</div></div>';

		return $sHtml;
	}

	public function SearchTemplate(WebPage $oPage): void
	{
		$oBlock = new DisplayBlock($this->oFilter, 'list', false);
		$oBlock->Display($oPage, "ResultsToSelect_{$this->sId}", [
			'cssCount' =>  "#count_{$this->sId}",
			'menu' => false,
			'selection_mode' => true,
			'selection_type' => $this->sSelectionMode,
			'table_id' => "select_{$this->sId}"
		]);
	}

	public function Display(WebPage $oPage): void
	{
		$oPage->add($this->GetSearchTemplateDlg($oPage));
	}

	public static function AddJSWidgetScript(WebPage $oPage) {
		$oPage->add_linked_script(utils::GetAbsoluteUrlModulesRoot().utils::GetCurrentModuleDir(0).'/js/select-object-template-widget.js');
	}
}