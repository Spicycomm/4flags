
import { Component, OnInit, ViewChild } from '@angular/core';
import { HomeService } from '../home.service'
import { FormBuilder, FormGroup, Validators } from '@angular/forms'
import { Constants } from '../../utils/constants'
import { ToastrService } from 'ngx-toastr';
import { NguCarouselConfig } from '@ngu/carousel';
import { Router, ActivatedRoute } from '@angular/router';
import { AuthService } from '../../shared/auth/auth.service'
import { StorageUtils } from '../../utils/storage-utils';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {

  @ViewChild('arrowPrev') arrowPrevEl: any
  @ViewChild('arrowNext') arrowNextEl: any

  loading: boolean = false;

  categories: any[] = [];
  products: any[] = [];

  productsSaleOff: any[] = [];

  preferences: any[] = [];

  banners: any[] = [];
  home = [];

  favTags: any[] = []
  userPreferences: any = {}
  idUser: string;

  public carouselBanner: NguCarouselConfig = {
    grid: { xs: 1, sm: 1, md: 1, lg: 1, all: 0 },
    slide: 1,
    speed: 250,
    point: {
      visible: true
    },
    load: 4,
    loop: true,
    velocity: 0,
    touch: true,
    easing: 'cubic-bezier(0, 0, 0.2, 1)'
  };


  public carouselTile: NguCarouselConfig = {
    grid: { xs: 1, sm: 1, md: 4, lg: 4, all: 0 },
    slide: 1,
    speed: 250,
    point: {
      visible: true
    },
    load: 2,
    velocity: 0,
    touch: true,
    easing: 'cubic-bezier(0, 0, 0.2, 1)',
    loop: true
  };


  //SERVICE_URL = SERVICE_URL
  constructor(private homeService: HomeService, private authService: AuthService, public  router: Router,
              private toastr: ToastrService, private storage: StorageUtils) {

  }
  

  showSuccess() {
    this.toastr.success('Preferências favoritadas com sucesso');
  }

  ngOnInit() {
    this.idUser = this.storage.getIdUser();
    
    this.homeService.getCategories()
      .subscribe(categories => this.categories = categories)


    this.homeService.banners({type: 'DESKTOP'})
      .subscribe(banners => this.banners = banners)

    this.homeService.getHome()
      .subscribe(home => {
        this.home = home['data']
        this.products = home['data'].listFeatured;
        this.productsSaleOff = home['data'].listSaleOff;
       }
      )

      this.homeService.getPreferences()
        .subscribe(preferences => this.preferences = preferences['data'])
  }

  

  handleArrowPrev() {
    this.arrowPrevEl.nativeElement.click();
  }

  handleArrowNext() {
    this.arrowNextEl.nativeElement.click();
  }

  logged() {
    return this.authService.isLoggedIn();
  }

  selectTags(tag) {
    let isExisting = !this.favTags.some(t => t.id == tag.id);

    if(isExisting) {
      this.favTags.push(tag);
    } else {
      this.favTags = this.favTags.filter(t => t.id != tag.id)
    }

  }

  sendTags() {
    //console.log(this.favTags)
    this.loading = true;

    if(!this.logged()) {
      setTimeout(()=> {
        this.router.navigate(['/login'])
      }, 1000)
    } else {

      this.userPreferences.id = this.storage.getIdUser()
      this.userPreferences.listPreferences = this.favTags;
      this.homeService.savePreference(this.userPreferences)
          .subscribe((preferences) => {
            this.toastr.success('Preferências salvas com sucesso')
            console.log(preferences)
          })
      console.log(this.userPreferences)
      setTimeout(()=> {
        this.loading = false;
      }, 1200)
    }
  }

  getUrl(idBanner: string): string {
    let url = `${Constants.SERVICE_URL}${Constants.SERVICE_PROJECT}banner/bannerImage/${idBanner}/DESKTOP`;
    return url;
  }


  onfavoriteProduct(product) {
    if(!this.logged()) {
        this.router.navigate(['/login'])
    } else {
      //this.toastr.success(`${product.name} adicionado aos favoritos`)
      this.homeService.favoriteProduct(product.id, this.storage.getIdUser())
        .subscribe((product) => console.log(product))
    }
    console.log(product);
  }
}
