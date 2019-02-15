import {Component, OnInit} from "@angular/core";
import {Game} from "../../game/game.model";
import {CartService} from "../cart/cart.service";

@Component({
  selector: 'app-wishlist',
  templateUrl: './wishlist.component.html'
})

export class WishlistComponent implements OnInit{
  wishlist: Game[];

  constructor(private cartService: CartService) {
  }

  ngOnInit() {
    this.loadWishlist();
  }

  loadWishlist(){
    this.cartService.getWishlist()
      .subscribe(data => this.wishlist = data);
  }

  removeFromWishlist(id: number){
    this.cartService.removeFromWishlist(id);
    location.reload();
  }
}
