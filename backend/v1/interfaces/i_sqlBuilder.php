<?php

namespace Interfaces;

interface I_SqlQueryBuilder
{
	public function BuildSQL();
	public function GetSQLQuery(): string;
}
