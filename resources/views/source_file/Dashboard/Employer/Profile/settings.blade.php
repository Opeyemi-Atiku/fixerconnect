@extends('layouts.layouts')

@section('content')

<!--Title-->
@include('source_file.Dashboard.Employer.inc.title_bar')
<!--Title-->

<section>
  <div class="block no-padding">
    <div class="container">
       <div class="row no-gape">
         <!--Menu-->
        @include('source_file.Dashboard.Employer.inc.menu_tab')
        <!--Menu-->

        <!--App-->
        <div class="col-lg-9 column">
          <div class="padding-left">
            <div class="profile-title">
              <h3>Settings</h3>
            </div>
            <div class="profile-form-edit">
              <form>
                <div class="row">
                  <div class="col-lg-6">
                    <span class="pf-title">Allow In Search</span>
                    <div class="pf-field">
                      <select data-placeholder="Allow In Search" class="chosen">
                        <option>Yes</option>
                        <option>No</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <span class="pf-title">Minimum Salary</span>
                    <div class="pf-field">
                      <input type="text" placeholder="$4250" />
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <span class="pf-title">Experience</span>
                    <div class="pf-field">
                      <select data-placeholder="Allow In Search" class="chosen">
                        <option>2-6 Years</option>
                        <option>6-12 Years</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <span class="pf-title">Age</span>
                    <div class="pf-field">
                      <select data-placeholder="Allow In Search" class="chosen">
                        <option>22-30 Years</option>
                        <option>30-40 Years</option>
                        <option>40-50 Years</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <span class="pf-title">Current Salary($) min</span>
                    <div class="pf-field">
                      <input type="text" placeholder="20K" />
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <span class="pf-title">Max</span>
                    <div class="pf-field">
                      <input type="text" placeholder="30K" />
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <span class="pf-title">Expected Salary($) min</span>
                    <div class="pf-field">
                      <input type="text" placeholder="30k" />
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <span class="pf-title">Max</span>
                    <div class="pf-field">
                      <input type="text" placeholder="40K" />
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <span class="pf-title">Education Levels</span>
                    <div class="pf-field">
                      <select data-placeholder="Please Select Specialism" class="chosen">
                        <option>Diploma</option>
                        <option>Inter</option>
                        <option>Bachelor</option>
                        <option>Graduate</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <span class="pf-title">Languages</span>
                    <div class="pf-field">
                      <div class="pf-field">
                        <select data-placeholder="Please Select Specialism" class="chosen">
                          <option>English</option>
                          <option>German</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <span class="pf-title">Categories</span>
                    <div class="pf-field no-margin">
                      <ul class="tags">
                             <li class="addedTag">Photoshop<span onclick="$(this).parent().remove();" class="tagRemove">x</span><input type="hidden" name="tags[]" value="Photoshop"></li>
                             <li class="addedTag">Digital & Creative<span onclick="$(this).parent().remove();" class="tagRemove">x</span><input type="hidden" name="tags[]" value="Digital"></li>
                             <li class="addedTag">Agency<span onclick="$(this).parent().remove();" class="tagRemove">x</span><input type="hidden" name="tags[]" value="Agency"></li>
                              <li class="tagAdd taglist">
                                   <input type="text" id="search-field">
                              </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <button type="submit">Update</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!--App-->

       </div>
    </div>
  </div>
</section>
@endsection
