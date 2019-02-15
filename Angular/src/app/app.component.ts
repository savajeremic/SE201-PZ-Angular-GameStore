import {Component, OnInit} from "@angular/core";
import {Router} from '@angular/router';
import {TimerObservable} from "rxjs/observable/TimerObservable";
import {User} from "./user/user.model";
import {Game} from "./game/game.model";
import {UserService} from "./user/user.service";
import {GameService} from "./game/game.service";
import {CartService} from "./user/cart/cart.service";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html'
})
export class AppComponent implements OnInit {
  token: User;
  genres: Game[];
  cart: Game[];
  totalPrice: number = 0;
  success: boolean = false;

  constructor(private userService: UserService,
    private gameService: GameService,
    private cartService: CartService,
    private router: Router) {
    this.token = JSON.parse(localStorage.getItem('token'));
  }

  ngOnInit() {
    if (this.token) {
      this.loadUser();
      this.loadCart();
    }
    this.loadGenres();
  }

  viewGame(id: number) {
    this.gameService.viewGame(id);
  }

  loadUser() {
    this.userService.getUser()
    .subscribe(data => {
      this.token = data;
    });
  }

  loadGenres(){
    this.gameService.getGenres()
      .subscribe(data => this.genres = data);
  }

  loadCart(){
    this.cartService.getCart()
      .subscribe(data => this.cart = data);
  }

  removeFromCart(id: number){
    this.cartService.removeFromCart(id);
    location.reload();
  }

  checkout(){
    this.success = true;
    this.cartService.checkout();
    let timer = TimerObservable.create(1000, 500);
    timer.subscribe(t => {
      location.reload();
      this.router.navigate(['/usergames']);
    });
  }

  logout() {
    this.userService.logout();
  }

  getSum() {
    let sum = 0;
    for (var i = 0; i < this.cart.length; i++){
      if (this.cart[i].price){
        sum += this.cart[i].price;
        this.totalPrice = sum;
      }
    }
    return sum;
  }

}
