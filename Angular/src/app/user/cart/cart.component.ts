import {Component, OnInit} from "@angular/core";
import {Router} from '@angular/router';
import {TimerObservable} from "rxjs/observable/TimerObservable";
import {Game} from "../../game/game.model";
import {GameService} from "../../game/game.service";
import {UserService} from "../user.service";
import {CartService} from "./cart.service";

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html'
})

export class CartComponent implements OnInit{
  cart: Game[];
  success: boolean = false;

  constructor(private gameService: GameService,
              private userService: UserService,
              private cartService: CartService,
              private router: Router) {
  }

  ngOnInit() {
    this.loadCart();
  }

  loadCart(){
    this.cartService.getCart()
      .subscribe(data => this.cart = data);
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
}
