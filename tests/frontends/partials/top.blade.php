            <div class="navbar navbar-default niftyNav" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle navTrigger" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ URL::to('/') }}">Nifty</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav niftyNavUl">
                        {{ $mainMenu }}
                    </ul>
                    {{ Form::open(['url' => 'search', 'method' => 'get', 'class' => 'navbar-form navbar-right'])  }}
                        <div class="input-group {{ $errors->first('term') ? 'has-error' : '' }}">
                            <?php $formValue = $errors->first('term') ? 'Enter search term' : '';  $formValue = isset($term) ? $term : $formValue; ?>
                            {{ Form::text('term', $formValue, ['class' => 'form-control', 'placeholder' => 'Search']) }}
                            <label for="searchSubmit" class="input-group-addon" style="cursor:pointer">
                                <i class="glyphicon glyphicon-search"></i>
                            </label>
                            <input id="searchSubmit" type="submit" class="hidden">                            
                        </div>
                    {{ Form::close() }}
                </div><!--/.nav-collapse -->
            </div> 