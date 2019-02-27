<?php

class TestingController{
	public function whois(){
		$domain='github.com';
		$apiKey = 'at_twCZ1Iyep1tM6bzWuQjBbJ0g4qiu3';
		$url = "https://www.whoisxmlapi.com/whoisserver/WhoisService?domainName={$domain}&apiKey={$apiKey}&outputFormat=JSON";
		$response = get_web_page($url);
		$res = json_decode($response['content'], true);
		return strtotime($res['WhoisRecord']['createdDate']);
	}
}