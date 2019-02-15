import {Injectable} from "@angular/core";
import {Observable} from "rxjs/Observable";
import {Game} from "../../game/game.model";
import {Http, Response} from "@angular/http";
import {Router} from '@angular/router';
import {apiUrl, SharedService} from "../../shared/shared.service";

@Injectable()
export class CartService {
  private url = apiUrl;

  constructor(private http: Http,
    private sharedService: SharedService,
    private router: Router) {
  }

  addToCart(game_id: number){
    let data = "game_id=" + game_id;
    let headers = this.sharedService.getHeaders();
    this.http.post(this.url + 'addtocart.php', data, {headers: headers})
    .map(res => res)
    .subscribe(data => data)
  }

  addToWishlist(game_id: number){
    let data = "game_id=" + game_id;
    let headers = this.sharedService.getHeaders();
    this.http.post(this.url + 'addtowishlist.php', data, {headers: headers})
    .map(res => res)
    .subscribe(data => data)
  }

  getCart(): Observable<Game[]> {
    let headers = this.sharedService.getHeaders();
    return this.http.get(this.url + 'getcart.php', {headers: headers})
      .map((response: Response) => <Game[]> response.json());
  }

  getWishlist(): Observable<Game[]> {
    let headers = this.sharedService.getHeaders();
    return this.http.get(this.url + 'getwishlist.php', {headers: headers})
      .map((response: Response) => <Game[]> response.json());
  }

  removeFromCart(game_id: number){
    let data = "game_id=" + game_id;
    let headers = this.sharedService.getHeaders();
    this.http.post(this.url + 'removefromcart.php', data, {headers: headers})
      .map(res => res)
      .subscribe(data => data)
  }

  removeFromWishlist(game_id: number){
    let data = "game_id=" + game_id;
    let headers = this.sharedService.getHeaders();
    this.http.post(this.url + 'removefromwishlist.php', data, {headers: headers})
      .map(res => res)
      .subscribe(data => data)
  }

  checkout(){
    let headers = this.sharedService.getHeaders();
    this.http.get(this.url + 'checkout.php', {headers: headers})
      .map(res => res)
      .subscribe(data => data)
  }
}
