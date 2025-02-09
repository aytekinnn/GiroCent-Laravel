@extends('frontend.layout')
@section('content')

    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area breadcrumb-bg" data-background="/frontend/img/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <h2>Sipariş Onaylama</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home.frontend.index')}}">Anasayfa</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Sipariş Onaylama</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="checkout-area pt-100 pb-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="checkout-wrap">
                            <h5 class="title">Kişisel Bilgileriniz</h5>
                            <form action="#" class="checkout-form">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-grp">
                                            <label for="fName">Adınız Soyadınız<span>*</span></label>
                                            <input type="text" id="fName" required value="{{Auth::user()->name}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-grp">
                                            <label for="phone">Telefon Numaranız <span>*</span></label>
                                            <input type="text" id="phone" required name="phone" value="{{Auth::user()->phone}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-grp">
                                            <label for="email">EMAIL ADDRESS <span>*</span></label>
                                            <input type="email" id="email" required value="{{Auth::user()->email}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-grp">
                                            <label for="tc">TC. Kimlik No <span>*</span></label>
                                            <input type="text" name="tc" required id="tc">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-grp">
                                            <label for="address">Adres *</label>
                                            <input type="text" name="address" required id="address">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-grp">
                                            <label>Ülke *</label>
                                            <select name="ulke" class="custom-select">
                                                <option value="Afganistan">Afghanistan</option>
                                                <option value="Albania">Albania</option>
                                                <option value="Algeria">Algeria</option>
                                                <option value="American Samoa">American Samoa</option>
                                                <option value="Andorra">Andorra</option>
                                                <option value="Angola">Angola</option>
                                                <option value="Anguilla">Anguilla</option>
                                                <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Armenia">Armenia</option>
                                                <option value="Aruba">Aruba</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Austria">Austria</option>
                                                <option value="Azerbaijan">Azerbaijan</option>
                                                <option value="Bahamas">Bahamas</option>
                                                <option value="Bahrain">Bahrain</option>
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="Barbados">Barbados</option>
                                                <option value="Belarus">Belarus</option>
                                                <option value="Belgium">Belgium</option>
                                                <option value="Belize">Belize</option>
                                                <option value="Benin">Benin</option>
                                                <option value="Bermuda">Bermuda</option>
                                                <option value="Bhutan">Bhutan</option>
                                                <option value="Bolivia">Bolivia</option>
                                                <option value="Bonaire">Bonaire</option>
                                                <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                                                <option value="Botswana">Botswana</option>
                                                <option value="Brazil">Brazil</option>
                                                <option value="British Indian Ocean Ter">British Indian Ocean Ter
                                                </option>
                                                <option value="Brunei">Brunei</option>
                                                <option value="Bulgaria">Bulgaria</option>
                                                <option value="Burkina Faso">Burkina Faso</option>
                                                <option value="Burundi">Burundi</option>
                                                <option value="Cambodia">Cambodia</option>
                                                <option value="Cameroon">Cameroon</option>
                                                <option value="Canada">Canada</option>
                                                <option value="Canary Islands">Canary Islands</option>
                                                <option value="Cape Verde">Cape Verde</option>
                                                <option value="Cayman Islands">Cayman Islands</option>
                                                <option value="Central African Republic">Central African Republic
                                                </option>
                                                <option value="Chad">Chad</option>
                                                <option value="Channel Islands">Channel Islands</option>
                                                <option value="Chile">Chile</option>
                                                <option value="China">China</option>
                                                <option value="Christmas Island">Christmas Island</option>
                                                <option value="Cocos Island">Cocos Island</option>
                                                <option value="Colombia">Colombia</option>
                                                <option value="Comoros">Comoros</option>
                                                <option value="Congo">Congo</option>
                                                <option value="Cook Islands">Cook Islands</option>
                                                <option value="Costa Rica">Costa Rica</option>
                                                <option value="Cote DIvoire">Cote DIvoire</option>
                                                <option value="Croatia">Croatia</option>
                                                <option value="Cuba">Cuba</option>
                                                <option value="Curaco">Curacao</option>
                                                <option value="Cyprus">Cyprus</option>
                                                <option value="Czech Republic">Czech Republic</option>
                                                <option value="Denmark">Denmark</option>
                                                <option value="Djibouti">Djibouti</option>
                                                <option value="Dominica">Dominica</option>
                                                <option value="Dominican Republic">Dominican Republic</option>
                                                <option value="East Timor">East Timor</option>
                                                <option value="Ecuador">Ecuador</option>
                                                <option value="Egypt">Egypt</option>
                                                <option value="El Salvador">El Salvador</option>
                                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                <option value="Eritrea">Eritrea</option>
                                                <option value="Estonia">Estonia</option>
                                                <option value="Ethiopia">Ethiopia</option>
                                                <option value="Falkland Islands">Falkland Islands</option>
                                                <option value="Faroe Islands">Faroe Islands</option>
                                                <option value="Fiji">Fiji</option>
                                                <option value="Finland">Finland</option>
                                                <option value="France">France</option>
                                                <option value="French Guiana">French Guiana</option>
                                                <option value="French Polynesia">French Polynesia</option>
                                                <option value="French Southern Ter">French Southern Ter</option>
                                                <option value="Gabon">Gabon</option>
                                                <option value="Gambia">Gambia</option>
                                                <option value="Georgia">Georgia</option>
                                                <option value="Germany">Germany</option>
                                                <option value="Ghana">Ghana</option>
                                                <option value="Gibraltar">Gibraltar</option>
                                                <option value="Great Britain">Great Britain</option>
                                                <option value="Greece">Greece</option>
                                                <option value="Greenland">Greenland</option>
                                                <option value="Grenada">Grenada</option>
                                                <option value="Guadeloupe">Guadeloupe</option>
                                                <option value="Guam">Guam</option>
                                                <option value="Guatemala">Guatemala</option>
                                                <option value="Guinea">Guinea</option>
                                                <option value="Guyana">Guyana</option>
                                                <option value="Haiti">Haiti</option>
                                                <option value="Hawaii">Hawaii</option>
                                                <option value="Honduras">Honduras</option>
                                                <option value="Hong Kong">Hong Kong</option>
                                                <option value="Hungary">Hungary</option>
                                                <option value="Iceland">Iceland</option>
                                                <option value="Indonesia">Indonesia</option>
                                                <option value="India">India</option>
                                                <option value="Iran">Iran</option>
                                                <option value="Iraq">Iraq</option>
                                                <option value="Ireland">Ireland</option>
                                                <option value="Isle of Man">Isle of Man</option>
                                                <option value="Israel">Israel</option>
                                                <option value="Italy">Italy</option>
                                                <option value="Jamaica">Jamaica</option>
                                                <option value="Japan">Japan</option>
                                                <option value="Jordan">Jordan</option>
                                                <option value="Kazakhstan">Kazakhstan</option>
                                                <option value="Kenya">Kenya</option>
                                                <option value="Kiribati">Kiribati</option>
                                                <option value="Korea North">Korea North</option>
                                                <option value="Korea Sout">Korea South</option>
                                                <option value="Kuwait">Kuwait</option>
                                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                <option value="Laos">Laos</option>
                                                <option value="Latvia">Latvia</option>
                                                <option value="Lebanon">Lebanon</option>
                                                <option value="Lesotho">Lesotho</option>
                                                <option value="Liberia">Liberia</option>
                                                <option value="Libya">Libya</option>
                                                <option value="Liechtenstein">Liechtenstein</option>
                                                <option value="Lithuania">Lithuania</option>
                                                <option value="Luxembourg">Luxembourg</option>
                                                <option value="Macau">Macau</option>
                                                <option value="Macedonia">Macedonia</option>
                                                <option value="Madagascar">Madagascar</option>
                                                <option value="Malaysia">Malaysia</option>
                                                <option value="Malawi">Malawi</option>
                                                <option value="Maldives">Maldives</option>
                                                <option value="Mali">Mali</option>
                                                <option value="Malta">Malta</option>
                                                <option value="Marshall Islands">Marshall Islands</option>
                                                <option value="Martinique">Martinique</option>
                                                <option value="Mauritania">Mauritania</option>
                                                <option value="Mauritius">Mauritius</option>
                                                <option value="Mayotte">Mayotte</option>
                                                <option value="Mexico">Mexico</option>
                                                <option value="Midway Islands">Midway Islands</option>
                                                <option value="Moldova">Moldova</option>
                                                <option value="Monaco">Monaco</option>
                                                <option value="Mongolia">Mongolia</option>
                                                <option value="Montserrat">Montserrat</option>
                                                <option value="Morocco">Morocco</option>
                                                <option value="Mozambique">Mozambique</option>
                                                <option value="Myanmar">Myanmar</option>
                                                <option value="Nambia">Nambia</option>
                                                <option value="Nauru">Nauru</option>
                                                <option value="Nepal">Nepal</option>
                                                <option value="Netherland Antilles">Netherland Antilles</option>
                                                <option value="Netherlands">Netherlands (Holland, Europe)</option>
                                                <option value="Nevis">Nevis</option>
                                                <option value="New Caledonia">New Caledonia</option>
                                                <option value="New Zealand">New Zealand</option>
                                                <option value="Nicaragua">Nicaragua</option>
                                                <option value="Niger">Niger</option>
                                                <option value="Nigeria">Nigeria</option>
                                                <option value="Niue">Niue</option>
                                                <option value="Norfolk Island">Norfolk Island</option>
                                                <option value="Norway">Norway</option>
                                                <option value="Oman">Oman</option>
                                                <option value="Pakistan">Pakistan</option>
                                                <option value="Palau Island">Palau Island</option>
                                                <option value="Palestine">Palestine</option>
                                                <option value="Panama">Panama</option>
                                                <option value="Papua New Guinea">Papua New Guinea</option>
                                                <option value="Paraguay">Paraguay</option>
                                                <option value="Peru">Peru</option>
                                                <option value="Phillipines">Philippines</option>
                                                <option value="Pitcairn Island">Pitcairn Island</option>
                                                <option value="Poland">Poland</option>
                                                <option value="Portugal">Portugal</option>
                                                <option value="Puerto Rico">Puerto Rico</option>
                                                <option value="Qatar">Qatar</option>
                                                <option value="Republic of Montenegro">Republic of Montenegro</option>
                                                <option value="Republic of Serbia">Republic of Serbia</option>
                                                <option value="Reunion">Reunion</option>
                                                <option value="Romania">Romania</option>
                                                <option value="Russia">Russia</option>
                                                <option value="Rwanda">Rwanda</option>
                                                <option value="St Barthelemy">St Barthelemy</option>
                                                <option value="St Eustatius">St Eustatius</option>
                                                <option value="St Helena">St Helena</option>
                                                <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                                                <option value="St Lucia">St Lucia</option>
                                                <option value="St Maarten">St Maarten</option>
                                                <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                                                <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                                                <option value="Saipan">Saipan</option>
                                                <option value="Samoa">Samoa</option>
                                                <option value="Samoa American">Samoa American</option>
                                                <option value="San Marino">San Marino</option>
                                                <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                                                <option value="Saudi Arabia">Saudi Arabia</option>
                                                <option value="Senegal">Senegal</option>
                                                <option value="Seychelles">Seychelles</option>
                                                <option value="Sierra Leone">Sierra Leone</option>
                                                <option value="Singapore">Singapore</option>
                                                <option value="Slovakia">Slovakia</option>
                                                <option value="Slovenia">Slovenia</option>
                                                <option value="Solomon Islands">Solomon Islands</option>
                                                <option value="Somalia">Somalia</option>
                                                <option value="South Africa">South Africa</option>
                                                <option value="Spain">Spain</option>
                                                <option value="Sri Lanka">Sri Lanka</option>
                                                <option value="Sudan">Sudan</option>
                                                <option value="Suriname">Suriname</option>
                                                <option value="Swaziland">Swaziland</option>
                                                <option value="Sweden">Sweden</option>
                                                <option value="Switzerland">Switzerland</option>
                                                <option value="Syria">Syria</option>
                                                <option value="Tahiti">Tahiti</option>
                                                <option value="Taiwan">Taiwan</option>
                                                <option value="Tajikistan">Tajikistan</option>
                                                <option value="Tanzania">Tanzania</option>
                                                <option value="Thailand">Thailand</option>
                                                <option value="Togo">Togo</option>
                                                <option value="Tokelau">Tokelau</option>
                                                <option value="Tonga">Tonga</option>
                                                <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                                                <option value="Tunisia">Tunisia</option>
                                                <option value="Turkey" selected>Turkey</option>
                                                <option value="Turkmenistan">Turkmenistan</option>
                                                <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                                                <option value="Tuvalu">Tuvalu</option>
                                                <option value="Uganda">Uganda</option>
                                                <option value="United Kingdom">United Kingdom</option>
                                                <option value="Ukraine">Ukraine</option>
                                                <option value="United Arab Erimates">United Arab Emirates</option>
                                                <option value="United States of America">United States of America
                                                </option>
                                                <option value="Uraguay">Uruguay</option>
                                                <option value="Uzbekistan">Uzbekistan</option>
                                                <option value="Vanuatu">Vanuatu</option>
                                                <option value="Vatican City State">Vatican City State</option>
                                                <option value="Venezuela">Venezuela</option>
                                                <option value="Vietnam">Vietnam</option>
                                                <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                                                <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                                                <option value="Wake Island">Wake Island</option>
                                                <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                                                <option value="Yemen">Yemen</option>
                                                <option value="Zaire">Zaire</option>
                                                <option value="Zambia">Zambia</option>
                                                <option value="Zimbabwe">Zimbabwe</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-grp">
                                            <label>Şehir *</label>
                                            <select name="sehir" class="custom-select">
                                                <option value="Adana">Adana</option>
                                                <option value="Adıyaman">Adıyaman</option>
                                                <option value="Afyonkarahisar">Afyonkarahisar</option>
                                                <option value="Ağrı">Ağrı</option>
                                                <option value="Amasya">Amasya</option>
                                                <option value="Ankara">Ankara</option>
                                                <option value="Antalya">Antalya</option>
                                                <option value="Artvin">Artvin</option>
                                                <option value="Aydın">Aydın</option>
                                                <option value="Balıkesir">Balıkesir</option>
                                                <option value="Bilecik">Bilecik</option>
                                                <option value="Bingöl">Bingöl</option>
                                                <option value="Bitlis">Bitlis</option>
                                                <option value="Bolu">Bolu</option>
                                                <option value="Burdur">Burdur</option>
                                                <option value="Bursa">Bursa</option>
                                                <option value="Çanakkale">Çanakkale</option>
                                                <option value="Çankırı">Çankırı</option>
                                                <option value="Çorum">Çorum</option>
                                                <option value="Denizli">Denizli</option>
                                                <option value="Diyarbakır">Diyarbakır</option>
                                                <option value="Düzce">Düzce</option>
                                                <option value="Edirne">Edirne</option>
                                                <option value="Elazığ">Elazığ</option>
                                                <option value="Erzincan">Erzincan</option>
                                                <option value="Erzurum">Erzurum</option>
                                                <option value="Eskişehir">Eskişehir</option>
                                                <option value="Gaziantep">Gaziantep</option>
                                                <option value="Giresun">Giresun</option>
                                                <option value="Gümüşhane">Gümüşhane</option>
                                                <option value="Hakkari">Hakkari</option>
                                                <option value="Hatay">Hatay</option>
                                                <option value="Iğdır">Iğdır</option>
                                                <option value="Isparta">Isparta</option>
                                                <option value="İstanbul">İstanbul</option>
                                                <option value="İzmir">İzmir</option>
                                                <option value="Kahramanmaraş">Kahramanmaraş</option>
                                                <option value="Karabük">Karabük</option>
                                                <option value="Karaman">Karaman</option>
                                                <option value="Kars">Kars</option>
                                                <option value="Kastamonu">Kastamonu</option>
                                                <option value="Kayseri">Kayseri</option>
                                                <option value="Kırıkkale">Kırıkkale</option>
                                                <option value="Kırklareli">Kırklareli</option>
                                                <option value="Kırşehir">Kırşehir</option>
                                                <option value="Kocaeli">Kocaeli</option>
                                                <option value="Konya">Konya</option>
                                                <option value="Kütahya">Kütahya</option>
                                                <option value="Malatya">Malatya</option>
                                                <option value="Manisa">Manisa</option>
                                                <option value="Mardin">Mardin</option>
                                                <option value="Mersin">Mersin</option>
                                                <option value="Muğla">Muğla</option>
                                                <option value="Muş">Muş</option>
                                                <option value="Nevşehir">Nevşehir</option>
                                                <option value="Niğde">Niğde</option>
                                                <option value="Ordu">Ordu</option>
                                                <option value="Osmaniye">Osmaniye</option>
                                                <option value="Rize">Rize</option>
                                                <option value="Sakarya">Sakarya</option>
                                                <option value="Samsun">Samsun</option>
                                                <option value="Siirt">Siirt</option>
                                                <option value="Sinop">Sinop</option>
                                                <option value="Sivas">Sivas</option>
                                                <option value="Tekirdağ">Tekirdağ</option>
                                                <option value="Tokat">Tokat</option>
                                                <option value="Trabzon">Trabzon</option>
                                                <option value="Tunceli">Tunceli</option>
                                                <option value="Şanlıurfa">Şanlıurfa</option>
                                                <option value="Şırnak">Şırnak</option>
                                                <option value="Tekirdağ">Tekirdağ</option>
                                                <option value="Tokat">Tokat</option>
                                                <option value="Trabzon">Trabzon</option>
                                                <option value="Van">Van</option>
                                                <option value="Yalova">Yalova</option>
                                                <option value="Yozgat">Yozgat</option>
                                                <option value="Zonguldak">Zonguldak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-grp">
                                            <label for="ilce">İlçe/Semt *</label>
                                            <input type="text" name="ilce" required id="ilce">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-grp">
                                            <label for="posta">Posta Kodu *</label>
                                            <input type="text" name="posta_kodu" required id="posta">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-grp">
                                            <label>İcra Dosyanız Var mı ? *</label>
                                            <select class="custom-select" required name="icraDosya">
                                                <option value="0">Evet var. Kalan borç 10.000₺ üstünde</option>
                                                <option value="1">Hayır yok hiç olmadı.</option>
                                                <option value="2">Hayır yok ödendi kapandı</option>
                                                <option value="3">Evet var. Kalan borç 10.000₺ altında</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-grp">
                                            <label>Son İş Yerinde Çalışma Süresi ? *</label>
                                            <select class="custom-select" required name="calismaSuresi">
                                                <option value="0">6 aydan az</option>
                                                <option value="1">6-12 ay</option>
                                                <option value="2">1-3 yıl</option>
                                                <option value="3">3-6 yıl</option>
                                                <option value="4">6 yıldan fazla</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-grp">
                                            <label>Aylık Gelir ? *</label>
                                            <select class="custom-select" required name="aylikGelir">
                                                <option value="0">22.000 ₺ altı</option>
                                                <option value="1">22.000 ₺ - 30.000 ₺</option>
                                                <option value="2">30.000 ₺ - 50.000 ₺</option>
                                                <option value="3">50.000 ₺ üzeri</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-grp">
                                            <label>Mal Varlığınız Var mı ? *</label>
                                            <select class="custom-select" required name="malValrligi">
                                                <option value="0">Ev</option>
                                                <option value="1">Araba</option>
                                                <option value="2">Arsa</option>
                                                <option value="3">Tarla</option>
                                                <option value="4">Yok</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-grp">
                                            <label for="dogum">Doğum Tarihi <span>*</span></label>
                                            <input type="date" required name="dogum_tarih" id="dogum">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-grp">
                                            <label for="medeni">Medeni Durum <span>*</span></label>
                                            <input type="text" required id="medeni" name="medeni_durum">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-grp">
                                            <label>Oturduğunuz Ev ? *</label>
                                            <select class="custom-select" required name="evDurum">
                                                <option value="0">Kira</option>
                                                <option value="1">Kendim</option>
                                                <option value="2">Lojman</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-grp">
                                            <label>Sgk Durumu ? *</label>
                                            <select class="custom-select" required name="sgkDurum">
                                                <option value="0">4A aktif işçi</option>
                                                <option value="1">4B bağkur</option>
                                                <option value="2">4C aktif memur</option>
                                                <option value="3">Emekle SSK</option>
                                                <option value="4">Emekli Memur</option>
                                                <option value="5">Pasif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-grp">
                                            <label for="baglanti">Bağlantı Kişi Adı Soyadı <span>*</span></label>
                                            <input type="text" id="baglanti" required placeholder="Size ulaşamadığımız durumlarda ulaşabileceğimiz bir yakınınızın bilgilerini giriniz" name="baglanti">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-grp">
                                            <label for="phone">Bağlantılı Kişi Telefon Numarası <span>*</span></label>
                                            <input type="text" required id="phone" name="baglantiTelefon">
                                        </div>
                                    </div>

                                    <input type="hidden" name="cartId" value="{{ $cartId }}">
                                    <input type="hidden" name="adet" value="{{ $adet }}">
                                    <input type="hidden" name="taksit" value="{{ $featuresIds }}">

                                    <div class="col-6">
                                        <div class="form-grp">
                                            <label for="cName">Şirket Tam Adı <span>*</span></label>
                                            <input type="text" name="company_name" id="cName" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-grp">
                                            <label for="cName">Şirket Görevi <span>*</span></label>
                                            <input type="text" name="sirket_gorev" id="cName" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-grp">
                                            <label for="cName">Ödeyebileceğiniz Maksimum Taksit Tutarı <span>*</span></label>
                                            <input type="text" name="maks_taksit_tutar" id="cName" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-grp">
                                            <label for="cName">Nüfusa Kayıtlı Olduğunuz İlçe <span>*</span></label>
                                            <input type="text" name="nufus_kayit_ilce" id="cName" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-grp position-relative">
                                            <label for="cName" class="d-flex align-items-center">
                                                E Devlet Şifresi <span>*</span>
                                                <i class="fas fa-info-circle ms-2 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="E-Devlet şifreniz, kimliğinizin doğrulanması ve başvuruların güvenilirliğinin sağlanması amacıyla istenmektedir. Bu adım, verdiğiniz bilgileri resmi kayıtlardaki verilerle eşleştirerek sahte veya hatalı başvuruların önüne geçmeyi hedefler. Kişisel verilerinizin güvenliği bizim için en öncelikli konudur; bilgileriniz yalnızca doğrulama süreci kapsamında kullanılmakta ve üçüncü taraflarla paylaşılmamaktadır."></i>
                                            </label>
                                            <input type="password" name="e_devlet_sifre" id="cName" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-grp">
                                            <label for="cName">Son Adreste İkamet Süresi <span>*</span></label>
                                            <input type="text" name="ikamet_suresi" id="cName" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-grp mb-0">
                                            <label for="message">Bildirmek istediğiniz özel bir mesaj ya da not varsa yazınız <small>(opsiyonel)</small></label>
                                            <textarea name="message" id="message"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkbox1" name="checkbox1" required>
                                            <label class="form-check-label" for="checkbox1">
                                                Kredili ürün almak amacıyla Yanlış veya yanıltıcı olan bilgileri bilerek sağlamanın ceza gerektiren bir suç olduğunu lütfen unutmayın.
                                                Bu kapsamda bilerek ve isteyerek yanıltıcı bilgi vermeniz halinde dolandırıcılık yasası 2006 ve benzeri kapsamındaki diğer suçlar için kovuşturmaya tabi tutulabilirsiniz.
                                                Sağlanan tüm bilgiler gizlilik içinde ve 2018 veri koruma yasası ve Avrupa Birliği Genel veri koruma yönetmenliği uyarınca ele alınacaktır.
                                                Bu bilgiler sadece formunuzu ilerletmek için kullanılacaktır. Bununla birlikte görevimizin bir parçası olarak ve dolandırıcılığını önlenmesi ve ortaya çıkabilmesi için
                                                Bilgilerinizi polis, diğer yerel yönetimler ve bu konsey bünyesindeki diğer ilgili departmanlar dahil olmak üzere diğer kurumlarla paylaşmak veya kontrol etmek zorunda kalabiliriz.
                                            </label>
                                        </div>

                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" id="checkbox2" name="checkbox2" required>
                                            <label class="form-check-label" for="checkbox2">
                                                Bu kutucuğu işaretlediğinizde verdiğiniz bilgileri doğrulamak üzere gerekli olan e-devlet ve benzeri incelemeleri yapabilmeleri için
                                                Girosen Teknoloji Mağazaları, Girocent Teknoloji, Necati Çoban veya emr-u havale adına yetki vermiş olursunuz.
                                            </label>
                                        </div>

                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" id="checkbox3" name="checkbox3" required>
                                            <label class="form-check-label" for="checkbox3">
                                                Bu kutucuğu işaretlediğinizde bu sipariş ile ilgili her türlü bilgi SMS uyarı, ihtar ve benzeri yazışmalar hesabınızdaki kayıtlı e-mail veya telefon ile yapılacağını
                                                ve bu yazışma ve ihtarların hukuken geçerli resmi yazışmalar olacağını kabul etmiş olursunuz.
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8">
                        <aside class="shop-cart-sidebar checkout-sidebar">
                            <div class="shop-cart-widget">
                                <h6 class="title">Toplam Sepet</h6>
                                <form action="#">
                                    @csrf
                                    <ul>
                                        <li><span>ARA TOPLAM</span> ₺ {{number_format($totalPrice, 2, ',', '.')}}</li>
                                        <li><span>İNDİRİMLİ TUTARI</span> ₺ {{number_format($totalDiscount, 2, ',', '.')}}</li>
                                        <li><span>EKSTRALAR</span> ₺ {{number_format($extraFeaturePrice, 2, ',', '.')}}</li>

                                        <li class="cart-total-amount"><span>TOPLAM FİYAT</span> <span class="amount"> ₺ {{number_format($toplamFiyat, 2, ',', '.')}}</span></li>
                                    </ul>
                                    <div class="payment-terms">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck7">
                                            <label class="custom-control-label" for="customCheck7">Satın alma koşulları,
                                            kullanıcı sözleşmesini okudum onaylıyorum.</label>
                                        </div>
                                    </div>
                                    <button class="btn onaya-gonder">ONAYA GÖNDER</button>
                                </form>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>


    </main>
    <script>
        document.querySelector(".checkout-form").addEventListener("submit", function(event) {
            let checkboxes = document.querySelectorAll(".form-check-input");
            let allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);

            if (!allChecked) {
                alert("Lütfen tüm kutucukları işaretleyin!");
                event.preventDefault();
            }
        });
        document.addEventListener("DOMContentLoaded", function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
        $(document).ready(function() {
            $('.onaya-gonder').click(function(e) {
                e.preventDefault();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var formData = {
                    _token: csrfToken,
                    name: $('#fName').val(),
                    phone: $('#phone').val(),
                    email: $('#email').val(),
                    tc: $('#tc').val(),
                    company_name: $('#cName').val(),
                    address: $('#address').val(),
                    ulke: $('select[name="ulke"]').val(),
                    sehir: $('select[name="sehir"]').val(),
                    ilce: $('#ilce').val(),
                    posta_kodu: $('#posta').val(),
                    icraDosya: $('select[name="icraDosya"]').val(),
                    calismaSuresi: $('select[name="calismaSuresi"]').val(),
                    aylikGelir: $('select[name="aylikGelir"]').val(),
                    malVarligi: $('select[name="malValrligi"]').val(),
                    dogum: $('#dogum').val(),
                    medeni_durum: $('#medeni').val(),
                    evDurum: $('select[name="evDurum"]').val(),
                    sgkDurum: $('select[name="sgkDurum"]').val(),
                    baglanti: $('#baglanti').val(),
                    baglantiTelefon: $('#phone').val(),
                    message: $('#message').val(),
                    cartId: $('input[name="cartId"]').val(),
                    adet: $('input[name="adet"]').val(),
                    taksit: $('input[name="taksit"]').val(),
                    sirket_gorev: $('input[name="sirket_gorev"]').val(),
                    maks_taksit_tutar: $('input[name="maks_taksit_tutar"]').val(),
                    nufus_kayit_ilce: $('input[name="nufus_kayit_ilce"]').val(),
                    e_devlet_sifre: $('input[name="e_devlet_sifre"]').val(),
                    ikamet_suresi: $('input[name="ikamet_suresi"]').val(),
                    checkbox1: $('input[name="checkbox1"]').is(':checked') ? 1 : 0,
                    checkbox2: $('input[name="checkbox2"]').is(':checked') ? 1 : 0,
                    checkbox3: $('input[name="checkbox3"]').is(':checked') ? 1 : 0
                };

                $.ajax({
                    url: '{{route('checkout.create')}}',
                    type: 'POST',
                    token: csrfToken,
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            window.location.href = response.redirect_url;
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Bir hata oluştu: ' + error);
                    }
                });
            });
        });
    </script>

@endsection
@section('css')@endsection
@section('js')@endsection
