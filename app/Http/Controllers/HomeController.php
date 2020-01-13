<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Firefox\FirefoxDriver;
use Facebook\WebDriver\Firefox\FirefoxProfile;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;
use Illuminate\Http\Request;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $domains = DB::table('tbl_pbn')->get();
        $keywords = DB::select(DB::raw("SELECT tbl_keyword.*,tbl_pbn.domain fROM tbl_keyword INNER JOIN tbl_pbn ON tbl_pbn.id = tbl_keyword.id_domain"));
        return view('pages.home',compact('domains','keywords'));
    }

    public function addDomain()
    {
        return view('pages.AddDomain');
    }

    public function postAddDomain(Request $request)
    {
        $this->validate($request,[
            'domain' => 'bail|required|unique:tbl_pbn',
            'dns' => 'bail|required',
            'cdn' => 'bail|required',
            'ip' => 'bail|required|ipv4',
            'name_register' => 'bail|required',
            'email' => 'bail|required|email',
            'register_date' => 'bail|required|date_format:d/m/Y',
            'expried_date' => 'bail|required|date_format:d/m/Y',

        ],[
            'domain.required' => 'Tên domain không được để trống',
            'domain.unique' => 'Tên domain đã tồn tại',
            'dns.required' => 'DNS không được để trống',
            'cdn.required' => 'CDN không được để trống',
            'ip.required' => 'IP không được để trống',
            'ip.ipv4' => 'IP không hợp lệ',
            'name_register.required' => 'Tên nhà đăng ký không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'register_date.required' => 'Ngày đăng ký không được để trống',
            'register_date.date_format' => 'Ngày đăng ký không hợp lệ',
            'expried_date.required' => 'Ngày hết hạn không được để trống',
            'expried_date.date_format' => 'Ngày hết hạn không hợp lệ',
        ]);

        DB::table('tbl_pbn')->insert([
            'domain' => $request->domain,
            'dns' => $request->dns,
            'cdn' => $request->cdn,
            'ip' => $request->ip,
            'name_register' => $request->name_register,
            'email' => $request->email,
            'expired_date' => $request->expried_date,
            'register_date' => $request->register_date,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);


        return redirect()->back()->with('message','success');
    }

    public function addkeyWord(Request $request)
    {
        $this->validate($request,[
            'id_domain' => 'bail|required',
            'keyword' => 'bail|required',

        ],[
            'id_domain.required' => 'Chọn một domain',
            'keyword.required' => 'Từ khóa không được để trống',
        ]);

        DB::table('tbl_keyword')->insert([
            'id_domain' => $request->id_domain,
            'key_word' => $request->keyword,
            'rank' => rand(1,10),
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);

        return redirect()->back()->with('message','success');
    }


    public function check_domain()
    {
        $domains = DB::table('tbl_pbn')->get();
        foreach ($domains as $domain)
        {
            $status = $this->get_Status_Domain($domain->domain);
            if($status == 200)
            {
                DB::table('tbl_pbn')->where('id',$domain->id)->update([
                    'status_domain' => 1,
                    'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                ]);
            }
            else
            {
                DB::table('tbl_pbn')->where('id',$domain->id)->update([
                    'status_domain' => 0,
                    'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                ]);
            }

        }

        return redirect()->back()->with('message2','success');
    }

    public function get_Status_Domain($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpcode;
    }

    public function check_keyword()
    {
        $this->seachSelenium(['abc','def']);
    }

    public function seachSelenium($listKey){
        $host = 'http://localhost:4444/wd/hub'; // this is the default
        $USE_FIREFOX = true; // if false, will use chrome.
        $caps = DesiredCapabilities::chrome();
        $prefs = array();
        $options = new ChromeOptions();
        $prefs['profile.default_content_setting_values.notifications'] = 2;
        $options->setExperimentalOption("prefs", $prefs);
        // firefox
        $profile = new FirefoxProfile();
        $profile->setPreference('network.proxy.type', 1);
        # Set proxy to Tor client on localhost
        $profile->setPreference('network.proxy.socks', '67.205.180.86');
        $profile->setPreference('network.proxy.socks_port', 28982);

        $caps = DesiredCapabilities::firefox();
        $caps->setCapability(FirefoxDriver::PROFILE, $profile);
        //$caps->setCapability(ChromeOptions::CAPABILITY, $options);
        // $capabilities = [
        //     WebDriverCapabilityType::BROWSER_NAME => 'firefox',
        //     WebDriverCapabilityType::PROXY => [
        //         'proxyType' => 'manual',
        //         'socksProxy' => '104.248.64.188:28982',
        //         //'sslProxy' => '127.0.0.1:2043',
        //     ],
        // ];
        // $caps->setCapability(
        //     'moz:firefoxOptions',
        //    ['args' => ['-headless']]
        // );
        if ($USE_FIREFOX)
        {
            $driver = RemoteWebDriver::create(
                $host,
                $caps
            );
        }
        else
        {
            $driver = RemoteWebDriver::create(
                $host,
                $caps
            );
        }
        $driver->get("https://www.google.com?hl=en");
        //$driver->get('https://whatismyip.com');die;
        # enter text into the search field
        try {
            $driver->findElement(WebDriverBy::cssSelector('input.gLFyf'))->click();
            sleep(1);
            $driver->findElement(WebDriverBy::cssSelector('input.gLFyf'))->sendKeys('allintitle:'.$listKey[0]['keyword']);
            sleep(1);
            $driver->findElement(WebDriverBy::cssSelector('div.FPdoLc .gNO89b'))->click();
            sleep(5);

            try {
                $id = $driver->findElement(WebDriverBy::id("resultStats"))->getAttribute('innerHTML');
                $tmp = explode('About',$id);
                $tmp = explode('results', $tmp[1]);
                $result = $tmp[0];
                $result = str_replace('.', '', $result);
                $this->updateKey($listKey[0]['keyword_id'], $result);
                //print_r($result.PHP_EOL);
                unset($listKey[0]);
                foreach ($listKey as $key => &$value) {
                    if($key ==0){
                        continue;
                    }
                    $driver->findElement(WebDriverBy::cssSelector('input.gLFyf'))->clear();
                    $driver->findElement(WebDriverBy::cssSelector('input.gLFyf'))->click();
                    sleep(1);
                    $driver->findElement(WebDriverBy::cssSelector('input.gLFyf'))->sendKeys('allintitle:'.$value['keyword']);
                    sleep(1);
                    $driver->findElement(WebDriverBy::cssSelector('button.Tg7LZd'))->click();
                    sleep(2);
                    try {
                        $id =$driver->findElement(WebDriverBy::id("resultStats"))->getAttribute('innerHTML');
                        //print_r($id.PHP_EOL);
                        $tmp = explode('About',$id);
                        $tmp = explode('results', $tmp[1]);
                        $result = $tmp[0];
                        $result = str_replace('.', '', $result);
                        $this->updateKey($value['keyword_id'], $result);
                        unset($listKey[$key]);
                    } catch (\Exception $e) {
                        echo 'fail';
                    }
                }
            } catch (\Exception $e) {
                $urlAry = $driver->executeScript('return window.location',array());
                $currentURL = $urlAry['href'];
                $recaptchaToken = $this->recaptcha($currentURL);
                if($recaptchaToken != false){
                    $driver->executeScript('document.getElementById("g-recaptcha-response").innerHTML = "'.$recaptchaToken.'"');
                    $driver->executeScript('document.getElementById("captcha-form").submit()');
                    sleep(10);
                    try {
                        $id =$driver->findElement(WebDriverBy::id("resultStats"))->getAttribute('innerHTML');
                        //print_r($id.PHP_EOL);
                        $tmp = explode('About',$id);
                        $tmp = explode('results', $tmp[1]);
                        $result = $tmp[0];
                        $result = str_replace('.', '', $result);
                        $this->updateKey($listKey[0]['keyword_id'], $result);
                        print_r($result.PHP_EOL);
                        unset($listKey[0]);
                        print_r($listKey);
                        foreach ($listKey as $key => $value) {
                            $driver->findElement(WebDriverBy::cssSelector('input.gLFyf'))->clear();
                            $driver->findElement(WebDriverBy::cssSelector('input.gLFyf'))->click();
                            sleep(1);
                            $driver->findElement(WebDriverBy::cssSelector('input.gLFyf'))->sendKeys('allintitle:'.$value['keyword']);
                            sleep(1);
                            $driver->findElement(WebDriverBy::cssSelector('button.Tg7LZd'))->click();
                            sleep(2);
                            try {
                                $id =$driver->findElement(WebDriverBy::id("resultStats"))->getAttribute('innerHTML');
                                //print_r($id.PHP_EOL);
                                if(strpos($id, 'About') !== false){
                                    $tmp = explode('About',$id);
                                    $tmp = explode('results', $tmp[1]);
                                    $result = $tmp[0];
                                    $result = str_replace('.', '', $result);
                                    $result = str_replace(',', '', $result);
                                    $this->updateKey($value['keyword_id'], $result);
                                    print_r($result.PHP_EOL);
                                    unset($listKey[$key]);
                                } else {
                                    $tmp = explode('result', $id);
                                    $result = $tmp[0];
                                    $result = str_replace('.', '', $result);
                                    $result = str_replace(',', '', $result);
                                    $this->updateKey($value['keyword_id'], $result);
                                    print_r($result.PHP_EOL);
                                    unset($listKey[$key]);
                                }
                            } catch (\Exception $e3) {
                                $urlAry = $driver->executeScript('return window.location',array());
                                $currentURL = $urlAry['href'];
                                if($currentURL == 'https://www.google.com/sorry/index'){
                                    $this->updateKey($listKey[$key]['keyword_id'], -2);
                                } else {
                                    $this->updateKey($listKey[$key]['keyword_id'], -1);
                                }
                                unset($listKey[$key]);
                            }

                        }
                    } catch (\Exception $e1) {
                        $urlAry = $driver->executeScript('return window.location',array());
                        $currentURL = $urlAry['href'];
                        if($currentURL == 'https://www.google.com/sorry/index'){
                            $this->updateKey($listKey[0]['keyword_id'], -2);
                        } else {

                            $this->updateKey($listKey[0]['keyword_id'], -1);
                            foreach ($listKey as $key => $value) {
                                $driver->findElement(WebDriverBy::cssSelector('input.gLFyf'))->clear();
                                $driver->findElement(WebDriverBy::cssSelector('input.gLFyf'))->click();
                                sleep(1);
                                $driver->findElement(WebDriverBy::cssSelector('input.gLFyf'))->sendKeys('allintitle:'.$value['keyword']);
                                sleep(1);
                                $driver->findElement(WebDriverBy::cssSelector('button.Tg7LZd'))->click();
                                sleep(2);
                                try {
                                    $id =$driver->findElement(WebDriverBy::id("resultStats"))->getAttribute('innerHTML');
                                    //print_r($id.PHP_EOL);
                                    if(strpos($id, 'About') !== false){
                                        $tmp = explode('About',$id);
                                        $tmp = explode('results', $tmp[1]);
                                        $result = $tmp[0];
                                        $result = str_replace('.', '', $result);
                                        $result = str_replace(',', '', $result);
                                        $this->updateKey($value['keyword_id'], $result);
                                        print_r($result.PHP_EOL);
                                        unset($listKey[$key]);
                                    } else {
                                        $tmp = explode('result', $id);
                                        $result = $tmp[0];
                                        $result = str_replace('.', '', $result);
                                        $result = str_replace(',', '', $result);
                                        $this->updateKey($value['keyword_id'], $result);
                                        print_r($result.PHP_EOL);
                                        unset($listKey[$key]);
                                    }
                                } catch (\Exception $e3) {
                                    $urlAry = $driver->executeScript('return window.location',array());
                                    $currentURL = $urlAry['href'];
                                    if($currentURL == 'https://www.google.com/sorry/index'){
                                        $this->updateKey($listKey[$key]['keyword_id'], -2);
                                    } else {
                                        $this->updateKey($listKey[$key]['keyword_id'], -1);
                                    }
                                    unset($listKey[$key]);
                                }

                            }
                        }
                        unset($listKey[0]);
                    }
                }
            }
        } catch (\Exception $captcha) {

        }
        //$driver->quit();
    }
}
