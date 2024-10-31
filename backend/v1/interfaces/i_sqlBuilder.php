<?php

namespace Interfaces;

interface I_SqlQueryBuilder
{
	public function buildSQLQuery();
	public function getSQLQuery(): string;
}
