<?php

namespace Interfaces;

interface I_SqlQueryBuilder
{
	public function BuildSQLQuery();
	public function GetSQLQuery(): string;
}
