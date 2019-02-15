import {Component, OnInit} from "@angular/core";
import {Game} from "../game.model";
import {GameService} from "../game.service";
import {UserService} from "../../user/user.service";
import {CartService} from "../../user/cart/cart.service";
import {Router, ActivatedRoute, Params} from '@angular/router';

@Component({
  selector: 'GameComponent',
  templateUrl: './game.component.html'
})
export class GameComponent implements OnInit {
  game: Game;

  constructor(private gameService: GameService,
              private userService: UserService,
              private cartService: CartService,
              private route: ActivatedRoute,
              private router: Router) {
  }

  ngOnInit() {
    this.route.params
      .subscribe(
        params => {
          let id = +params['id'];
          this.loadGame(id);
        }
      );
  }

  loadGame(id: number) {
    this.gameService.getGame(id)
      .subscribe(data => this.game = data);
  }

  addToCart(game_id: number){
    this.cartService.addToCart(game_id);
    location.reload();
  }
}
