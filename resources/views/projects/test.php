<?
function getUserHireDate($user_id) {
    $arSelect = array('SELECT'=>array("ID","PERSONAL_ICQ","UF_MIGDATA"));
    $rsUsers = CUser::GetList(($by="NAME"),($order="desc"),array("ID"=>$user_id),$arSelect);
    if($arUser = $rsUsers->Fetch()) return $arUser["UF_MIGDATA"]; else return false;
}
function GetUserFMGcode($user_id) {
  $arSelect = array('SELECT'=>array("ID","PERSONAL_ICQ","UF_FMG_CODE2"));
  $rsUsers = CUser::GetList(($by="NAME"),($order="desc"),array("ID"=>$user_id),$arSelect);
  if($arUser = $rsUsers->Fetch()) return $arUser["UF_FMG_CODE2"]; else return false;
}
function GetDepartmentName($dep) { $title = \Bitrix\Main\UserUtils::getDepartmentName(intVal($dep)); return $title["NAME"]; }
function GetUserId($userid) { $user=explode("_",$userid); return $user[1]; }
function ConvertTimeForElma($param) { $date=explode("/",$param); /* m0/d1/Y2 */ return "{$date[2]}-{$date[0]}-{$date[1]}"; }

$elma = array();
$rootActivity = $this->GetRootActivity();
$elma["department_id"] = "335";
$elma["department_name"] = GetDepartmentName($elma["department_id"]);
$elma["xelfasi"] = "0";
$elma["date"]	= ConvertTimeForElma( date('m/d/Y') ); // $rootActivity->GetVariable("elma_date")
$elma["userid"] = GetUserId( $rootActivity->GetVariable("_TANAM") );
$elma["fmg_code"] = GetUserFMGcode( $elma["userid"] );
$elma["datestart"] = ConvertTimeForElma( getUserHireDate( $elma["userid"]) );

$this->SetVariable("result", json_encode($elma, JSON_UNESCAPED_UNICODE) );

CModule::IncludeModule('webservice');
$client = new CSOAPClient("192.168.2.9:159", '/FMG_ELMA.asmx');
$request = new CSOAPRequest("EmployJobApply", "http://fmgsoft.ge/");
//$request->addSOAPHeader("soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\"");

$request->addParameter("PostName",  $elma["department_name"]); // department name
$request->addParameter("PostId",    $elma["department_id"]); // department id
$request->addParameter("Depart_ID", $elma["department_id"]); // department id
$request->addParameter("EmplKod",   $elma["fmg_code"]); // fmg ID userebidan
$request->addParameter("StartDate", $elma["datestart"]); // STARTDATE
$request->addParameter("EndtDate",  $elma["date"]); // ENDEDDATE
$request->addParameter("Tanxa",     $elma["xelfasi"]); // XELFAS
$request->addParameter("ElmaID",    "333"); // iyos eg
$request->addParameter("Vid",       "20"); // 01 - migeba || 10 - gadayvana || 90 - gantavisufleba || 20 || 21

$response = $client->send( $request );
//$rr=$response[0]["Kod"];
$this->SetVariable("result", json_encode($response->Value, JSON_UNESCAPED_UNICODE) );