
@extends('teachers.layouts.app')

@section('page_name')

	

    Appréciations de la classe {{ $classe->name }}


@endsection

@section('css')
<!--<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>-->
    <link href="/bower_components/footable/css/footable.core.css" rel="stylesheet">
    <link href="/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet"/>
    <link href="/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet"/>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/reviews.css">
     <!--<link rel="stylesheet" type="text/css" href="/css/carousel-reviews.css">-->
     <!-- toastr notifications -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<style>
.carousel-control              { width:  4%; }
.carousel-control.left,.carousel-control.right {margin-left:15px;background-image:none;}
.carousel-caption h3{
	top:80%;
	font-weight: bold;
	font-size: 1.1em;
}
@media (max-width: 767px) {
    .carousel-inner .active.left { left: -50%; }
    .carousel-inner .next        { left:  50%; }
    .carousel-inner .prev        { left: -50%; }
    .active > div { display:none; }
    .active > div:first-child { display:block; }
    .active > div:first-child + div { display:block; }
}


  </style>

    
@endsection
@section('javascript')
    <script src="/bower_components/footable/js/footable.all.min.js"></script>
    <script src="/bower_components/bootstrap-select/bootstrap-select.min.js"
            type="text/javascript"></script>
    <script src="/js/footable-init.js"></script>

   
  <script src="https://use.fontawesome.com/6f2d9a9d07.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script type="text/javascript">
 !function ($) {

    var is,
		transition;

	// from valentine
	is = {
		fun: function (f) {
			return typeof f === 'function';
		},
		arr: function (ar) {
			return ar instanceof Array;
		},
		obj: function (o) {
			return o instanceof Object && !is.fun(o) && !is.arr(o);
		}
	};

	/*
		Based on Bootstrap
		Mozilla and Webkit support only
	*/
	transition = (function () {
		var st = document.createElement('div').style,
			transitionEnd = 'TransitionEnd',
			transitionProp = 'Transition',
			support = st.transition !== undefined ||
				st.WebkitTransition !== undefined ||
				st.MozTransition !== undefined;

		return support && {
			prop: (function () {
				if (st.WebkitTransition !== undefined) {
					transitionProp = 'WebkitTransition';
				} else if (st.MozTransition !== undefined) {
					transitionProp = 'MozTransition';
				}
				return transitionProp;
			}()),
			end: (function () {
				if (st.WebkitTransition !== undefined) {
					transitionEnd = 'webkitTransitionEnd';
				} else if (st.MozTransition !== undefined) {
					transitionEnd = 'transitionend';
				}
				return transitionEnd;
			}())
		};
	}());

	function extend() {
		// based on jQuery deep merge
		var options, name, src, copy, clone,
			target = arguments[0], i = 1, length = arguments.length;

		for (; i < length; i += 1) {
			if ((options = arguments[i]) !== null) {
				// Extend the base object
				for (name in options) {
					src = target[name];
					copy = options[name];
					if (target === copy) {
						continue;
					}
					if (copy && (is.obj(copy))) {
						clone = src && is.obj(src) ? src : {};
						target[name] = extend(clone, copy);
					} else if (copy !== undefined) {
						target[name] = copy;
					}
				}
			}
		}
		return target;
	}

	function clone(obj) {
		if (null === obj || 'object' !== typeof obj) {
			return obj;
		}
		var copy = obj.constructor(),
			attr;
		for (attr in obj) {
			if (obj.hasOwnProperty(attr)) {
				copy[attr] = obj[attr];
			}
		}
		return copy;
	}

	// from jquery
	function proxy(fn, context) {
		var slice = Array.prototype.slice,
			args = slice.call(arguments, 2);
		return function () {
			return fn.apply(context, args.concat(slice.call(arguments)));
		};
	}

	function animate(options) {
		var el = options.el,
			complete = options.complete ? options.complete : function () {},
			animation,
			dummy;

		// no animation obj OR animation is not available,
		// fallback to css and call the callback
		if (! options.animation ||
			! (el.animate || (options.css3transition && transition))) {
			el.css(options.fallbackCss);
			complete();
			return;
		}

		// we will animate, apply start CSS
		if (options.animStartCss) {
			if (options.animStartCss.opacity === 0) {
				options.animStartCss.opacity = 0.01; // ie quirk
			}
			el.css(options.animStartCss);
		}
		animation = options.animation;

		// css3 setted, if available apply the css
		if (options.css3transition && transition) {
			dummy = el[0].offsetWidth; // force reflow; source: bootstrap
			el[0].style[transition.prop] = 'all ' + animation.duration + 'ms';

			// takaritas
			delete animation.duration;
			delete animation.easing;

			el.css(animation);
			//el.unbind(transition.end);
			el.on(transition.end, function () {
				// delete transition properties and events
				el.off(transition.end);
				el[0].style[transition.prop] = 'none';
				complete();
			});
		} else if (window.ender) {
			// use morpheus
			el.animate(extend(animation, {'complete': complete}));
		} else {
			// use animate from jquery
			el.animate(animation, animation.duration, animation.easing, complete);
		}
	}

	/*
		Carousel Constructor
	*/
	function Carousel(el, options) {
		this.init(el, options);

		// only return the API
		// instead of this
		return {
			getPageSize: proxy(this.getPageSize, this),
			getCursor: proxy(this.getCursor, this),
			nextPage: proxy(this.nextPage, this),
			prevPage: proxy(this.prevPage, this),
			isVisibleItem: proxy(this.isVisibleItem, this),
			scrollToItem: proxy(this.scrollToItem, this),
			getOptions: proxy(this.getOptions, this),
			setOptions: proxy(this.setOptions, this)
		};
	}

	Carousel.prototype = {
		init: function (el, options) {
			var opt;

			this.options = {
				window: '.carousel-inner',
				items: '.item',
				pager: null,
				nextPager: 'a.next',
				prevPager: 'a.prev',
				activeClass: null,
				disabledClass: 'disabled',
				duration: 400,
				vertical: false,
				keyboard: false,
				css3transition: false,
				extraOffset: 0
			};
			this.setOptions(options);
			opt = this.options;

			if (opt.css3transition && ! transition) {
				opt.css3transition = false;
			}

			this.$el = $(el);
			this.$window = this.$el.find(
				opt.window
			);
			this.$itemWrapper = this.$window.children().first();
			this.$items = this.$el.find(
				opt.items
			);
			this.$nextPager = this.$el.find(
				opt.nextPager
			);
			this.$prevPager = this.$el.find(
				opt.prevPager
			);

			this.setDimensions();

			if (opt.pager) {
				this.$pager = this.$el.find(
					opt.pager
				);

				this.createPager();

				this.$pagerItems = this.$pager.find('li');
			}

			if (this.$items.length <= this.pageSize) {
				this.hidePrevPager();
				this.hideNextPager();
				return;
			}

			this.cursor = this.getActiveIndex();

			if (this.cursor < 0) {
				if (this.options.activeClass) {
					for (var i = 0; i < this.pageSize; i += 1) {
						$(this.$items.get(i)).addClass('active');
					}
				}

				this.cursor = 0;
			}

			if (this.cursor > this.lastPosition) {
				this.cursor = this.lastPosition;
			}

			if (this.cursor > 0) {
				this.scrollToItem(this.cursor, true);
			}

			if (this.cursor === 0) {
				this.hidePrevPager();
			}

			if (this.cursor >= this.lastPosition) {
				this.hideNextPager();
			}

			this.$nextPager.on('click', proxy(this.nextPage, this));
			this.$prevPager.on('click', proxy(this.prevPage, this));

			if (opt.keyboard) {
				$(document).on('keyup', proxy(this.onKeyUp, this));
			}

			this.$el.addClass('carousel-inited');
		},

		setDimensions: function () {
			var $secondItem,
				alignedDimension = 'width',
				marginType = ['margin-left', 'margin-right'];

			if (this.options.vertical) {
				alignedDimension = 'height';
				marginType = ['margin-top', 'margin-bottom'];
			}

			$secondItem = this.$items.first().next();
			this.itemMargin = parseInt($secondItem.css(marginType[0]), 10) +
				parseInt($secondItem.css(marginType[1]), 10);
			this.itemDimension = $secondItem[alignedDimension]() + this.itemMargin;

			this.windowDimension = this.$window[alignedDimension]();
			this.pageSize = Math.floor(
				(this.windowDimension + this.itemMargin) / this.itemDimension
			);
			this.pageDimension = this.pageSize * this.itemDimension;
			this.lastPosition = this.$items.length - this.pageSize;

		},

		createPager: function () {
			var itemsLen = this.$items.length,
				pagerItemsFrag = document.createDocumentFragment(),
				pagerItem,
				i;

			for (i = 0; i < itemsLen; i += 1) {
				pagerItem = document.createElement('li');
				$pagerItem = $(pagerItem);

				$pagerItem.on('click', proxy(this.usePager, this, i, itemsLen));

				if (i < this.pageSize) {
					$pagerItem.addClass('active');
				}

				pagerItemsFrag.appendChild(pagerItem);
			}

			this.$pager.empty().get(0).appendChild(pagerItemsFrag);
		},

		usePager: function (pos, len) {
			if (pos > (len - this.pageSize)) {
				this.scrollToItem(len - this.pageSize);
			} else {
				this.scrollToItem(pos);
			}
		},

		nextPage: function (e) {
			if (typeof(e) !== 'undefined') {
				e.preventDefault();
			}

			if (this.cursor >= this.lastPosition) {
				return;
			}

			var itemIdx = this.cursor + this.pageSize;
			if (itemIdx > this.lastPosition) {
				itemIdx = this.lastPosition;
			}

			this.scrollToItem(itemIdx);
		},

				prevPage: function (e) {	
			if (typeof(e) !== 'undefined') {
				e.preventDefault();
			}

			if (this.cursor === 0) {
				return;
			}

			var itemIdx = this.cursor - this.pageSize;	
			if (itemIdx < 0) {
				itemIdx = 0;
			}

			this.scrollToItem(itemIdx);
		},

		nextItem: function () {
			if (this.cursor >= this.lastPosition) {
				return;
			}

			this.scrollToItem(this.cursor + 1);
		},

		prevItem: function () {
			if (this.cursor === 0) {
				return;
			}
			this.scrollToItem(this.cursor - 1);
		},

		scrollToItem: function (idx, doNotAnimate) {
			var animateTo,
				scrollTo,
				direction = this.options.vertical ? 'top' : 'left',
				animObj = {},
				activeClassName = this.options.activeClass || 'active',
				itemsLen = this.$items.length,
				i;

			this.cursorPrevious = this.cursor;
			this.cursor = idx;

			if (this.cursor === 0) {
				this.hidePrevPager();
			} else {
				this.showPrevPager();
			}

			if (this.cursor >= this.lastPosition) {
				this.hideNextPager();
			} else {
				this.showNextPager();
			}

			scrollTo = this.cursor * this.itemDimension;
			if (this.cursor === this.lastPosition) {
				scrollTo = scrollTo -
					(this.windowDimension - this.pageDimension + this.itemMargin) +
					this.options.extraOffset;
			}

			scrollTo *= -1;
			animObj[direction] = scrollTo;

			if (! doNotAnimate) {
				animObj.duration = this.options.duration;
			}

			if (this.options.activeClass) {
				activeClass = this.options.activeClass;

				if (this.getPageSize() === 1) {
					$(this.$items.get(this.cursorPrevious)).removeClass(activeClass);
					$(this.$items.get(idx)).addClass(activeClass);
				} else {
					itemslen = this.$items.length;
					this.$items.removeClass(activeClass);

					for (i = 0; i < itemslen; i += 1) {
						if (this.isVisibleItem(i)) {
							$(this.$items.get(i)).addClass(activeClass);
						}
					}
				}
			}

			if (this.options.pager) {
				if (this.getPageSize() === 1) {
					$(this.$pagerItems.get(this.cursorPrevious)).removeClass(activeClassName);
					$(this.$pagerItems.get(this.cursor)).addClass(activeClassName);
				} else {
					this.$pagerItems.removeClass(activeClassName);

					for (i = 0; i < itemsLen; i += 1) {
						if (this.isVisibleItem(i)) {
							$(this.$pagerItems.get(i)).addClass(activeClassName);
						}
					}
				}
			}

			animate({
				el: this.$itemWrapper,
				animation: doNotAnimate ? false : animObj,
				fallbackCss: animObj,
				css3transition: this.options.css3transition
			});
		},

		onKeyUp: function (e) {
			if (e.keyCode === 39) {
				this.nextPage();
			} else if (e.keyCode === 37) {
				this.prevPage();
			}
		},

		getActiveIndex: function () {
			var i = 0,
				il = this.$items.length;

			for (; i < il; i += 1) {
				if ($(this.$items.get(i)).hasClass('active')) {
					return i;
				}
			}

			return -1;
		},

		hideNextPager: function () {
			this.$nextPager.addClass(
				this.options.disabledClass
			);
		},

		hidePrevPager: function () {
			this.$prevPager.addClass(
				this.options.disabledClass
			);
		},

		showNextPager: function () {
			this.$nextPager.removeClass(
				this.options.disabledClass
			);
		},

		showPrevPager: function () {
			this.$prevPager.removeClass(
				this.options.disabledClass
			);
		},

		getPageSize: function () {
			return this.pageSize;
		},

		getCursor: function () {
			return this.cursor;
		},

		isVisibleItem: function (idx) {
			if (this.cursor + this.pageSize <= idx || this.cursor > idx) {
				return false;
			}
			return true;
		},

		getOptions: function () {
			return this.options;
		},

		setOptions: function (options) {
			extend(this.options, options || {});
		}
	};

	$.fn.carousel = function (options) {
		return new Carousel(this.first(), options);
	};
}(window.ender || window.jQuery || window.Zepto);


$(document).ready(function () {
    $("#vertical-thin").carousel({
        vertical: true
    });
});
</script>

</head>
   
@endsection

@section('content')
 <script type="text/javascript">
$(document).ready(function(){
$('.carousel[data-type="multi"] .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));
  
  for (var i=0;i<2;i++) {
    next=next.next();
    if (!next.length) {
        next = $(this).siblings(':first');
    }
    
    next.children(':first-child').clone().appendTo($(this));
  }
});
});
  </script>

<div class="hidden-lg col-md-12 col-sm-12 col-xs-12 ">
<div class="carousel slide" data-ride="carousel" data-type="multi" data-interval="4000" id="myCarousel" data-pause="hover">
  <div class="carousel-inner">
    @foreach($classe->students as $i => $student)
      @if($student === reset($classe->students))
    <div class="item active">
        <div class="col-md-3 col-sm-3 col-xs-6">
         
         <img src="{{$student->avatar}}" class="img-responsive" >
         <a href="{{route('single.posting',['id'=>$student->student_id,'class'=>$classe->id])}}">
         <div class="carousel-caption">
                 <p>{{$student->name}}</p>
                 <h3>{{$student->last_name}}</h3>
         </div>
         </a>
    </div>
  </div>
    @endif
    @endforeach
   
      @foreach(array_slice($classe->students,1) as $i => $student)
      
    <div class="item">
      
        <div class="col-md-3 col-sm-3 col-xs-6">
              <img src="{{$student->avatar}}" class="img-responsive" >
              <a href="{{route('single.posting',['id'=>$student->student_id,'class'=>$classe->id])}}">
              <div class="carousel-caption">
                 <p>{{$student->name}}</p>
                 <h3>{{$student->last_name}}</h3>
              </div>
              </a>
        </div>
    
   </div>
    
    @endforeach
  </div>
  <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
</div>
</div>



<div class="container">
	<div class="row">
         
        <div class="col-lg-2 hidden-md hidden-sm hidden-xs">

            <div class="carousel thin" id="vertical-thin">
                <a class="prev"><span class="glyphicon glyphicon-chevron-up"></span></a>
               
               
                <div class="carousel-inner" id="vertical-inner">
                    <ul class="clr">  
                        
                       @foreach($classe->students as $i => $student)
                           
                          <li class="item">
                           <a href="{{route('single.posting',['id'=>$student->student_id,'class'=>$classe->id])}}"><img src="{{$student->avatar}}"></a>
                                    <div class="carousel-caption">
                                        
                                    </div>
                          </li>
                       
                        @endforeach
                    </ul>
                </div> <!-- .carousel-inner -->
               <a class="next"><span class="glyphicon glyphicon-chevron-down"></span></a>
            </div> <!-- .carousel-slide -->
       </div><!-- .carousel-thin -->
    


       
       
      <div class="col-lg-9 col-md-11 col-sm-11 col-xs-11" id="student-container">
     
       <div class="row">
				
				
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			         <div class="info-box i1">
			         

                        <img src="{{$studenting->user->avatar}}" alt="" />
                        
                        <i class="fa fa-user"></i>
                         
                         <a href = ""> <button class="btn btn-primary " >Liste des Utilisateurs</button></a>
                         

                       		
					  </div>	
			</div><!--/.col-->	
				
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				 <div class="info-box i2">
				    
				        <img src="/images/reviews/bg-3.png" alt="" />
						<i class="fa fa-info "></i>
						
                        <h4>Eléve:{{$studenting->user->last_name}}  {{$studenting->user->name}}</br>
                            </h4>
                        <h5>E-Mail:{{$studenting->user->email}}</br>
                            Statut:{{$studenting->user->rank}} en {{$classe->name}}</h5>
                            
                        <a href = ""> <button class="btn btn-primary pull-right" type="submit" >Liste des Utilisateurs</button></a>
		
					 		
				</div><!--/.info-box-->			
			</div><!--/.col-->
				
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					
					<div class="info-box i3">
					  
				        <img src="/images/reviews/bg-2.png" alt="" />
						<i class="fa fa-file-text "></i>
						
                      
                         <div class="target">
                               @if(isset($studenting->review->review))
                                   <div id="target1" data-postid="{{$studenting->review->id}}">
                                   <h4 class="target2"> {{$studenting->review->review}}</h4>
                      
                                    <a href="#" data-toggle="modal" class="modify"><button class="btn btn-primary pull-right">Modifier l'appéciation</button></a>
                                  </div><!--div target1-->
                               @else

                                   <h4 class="target3"></h4>

                                   <a href="#" data-toggle="modal" class="modify"><button class="btn btn-primary pull-right">Modifier l'appéciation</button></a>

                                   <a href="#" data-toggle="modal" class="adding"><button class="btn btn-primary pull-center" >Ajouter une appréciation</button></a>
                               
                               @endif

					 	 </div><!--target-->	
					 		
				    </div><!--/.info-box-->			
		  </div><!--/.col-->
				
		</div><!--/.row-->
      </div>
       
    </div>
</div>
<!-- Modal-Window/Ajax -->

     <div class="modal fade" data-dismiss="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			    	
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="title">Ajouter Une Appréciation</h4>
				      </div>
				      
				      <div class="modal-body">
				  
                                               {{csrf_field()}}
                                               <textarea class="form-control" type="text" id="review1" name="review" row="4"></textarea>
                                               <input type="hidden" id="student_id" name="student_id" value={{$studenting->id}}>
                                               <input type="hidden" id="class_id" name="class_id" value={{$student->classe_id}}>
                                               <input type="hidden" id="matiere_id" name="matiere_id" value={{$student->classe_id}}>

              
                                              <div class="modal-footer">
                                                   <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                                  
                                                   <button class="btn btn-primary" type="submit" id="modal-add">Ajouter</button>
                                                   <button class="btn btn-primary" type="submit" id="modal-save" >Modifier</button>
                                              </div>


                                   
                     </div>                           
				     
			 </div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
	


<!--<script>

 $('#AddButton').click(function(event) {
 var text = $('#addItem').val();
 $.post('/teacher/reviews/add', {'review': text,'_token':$('input[name=_token]').val(),}, function(data) {
// $('#items').load(location.href + ' #items');
 console.log(data);
 });
// });
</script>-->
<script>
 var postId = 0;
 var postBodyElement=null;

$('.i3').find('.target').find('.adding').on('click', function (event) {
    event.preventDefault();
      $('.modify').hide(400);
      $('#modal-save').hide(400);
      modals('Ajouter une Appréciation');
   
});



$('#modal-add').on('click', function () {
   
    $.ajax({
            method: 'POST',
            url: urlAdd,
            data: {review: $('#review1').val(),student_id: $('#student_id').val(),class_id: $('#class_id').val(),matiere_id: $('#matiere_id').val(), _token: token}
        })
        .done(function (data) {
            $('.target3').text(data['first_body']);
            $('.adding').hide(400);
            $('.modify').show(400);
            $('#myModal').modal('hide');
            //location.reload();        
        });
});

   $('.i3').find('.target').find('.modify').on('click', function (event) {
    event.preventDefault();

      postBodyElement = event.target.parentNode.parentNode.childNodes[1];
      //postBodyElement = $('.target2');
      var postBody = postBodyElement.textContent;
      //var postBody = $('.target').textContent;
      postId = event.target.parentNode.parentNode.dataset['postid'];
      //postId = $('#target1').dataset['postid'];
      $('#modal-add').hide(400);
      $('#review1').val(postBody);
      modals('Modifier une Appréciation')
   
});

   $('#modal-save').on('click', function () {
    $.ajax({
            method: 'POST',
            url: urlEdit,
            data: {review: $('#review1').val(),student_id: $('#student_id').val(),class_id: $('#class_id').val(),matiere_id: $('#matiere_id').val(), postId: postId, _token: token}
        })
        .done(function (data) {
          // $(postBodyElement).text(data['new_body']);
            $('.target2').text(data['new_body']);

            $('#myModal').modal('hide');
        });
});

  var token = '{{ Session::token() }}';
        var urlEdit = '{{ url('/teacher/reviews/hellcat')}}';
        var urlAdd = '{{ url('/teacher/reviews/add')}}';

  function modals(title){
  	$('#myModal').modal();
    $('.modal-title').text(title);
  }
        
</script>

@endsection

