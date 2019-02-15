import {Component, OnInit} from "@angular/core";
import {Game} from "./game.model";
import {User} from "../user/user.model";
import {GameService} from "./game.service";
import {UserService} from "../user/user.service";
import {CartService} from "../user/cart/cart.service";

@Component({
  selector: 'app-games',
  templateUrl: './games.component.html'
})
export class GamesComponent implements OnInit {
  games: Game[];
  token: User;

  constructor(private gameService: GameService,
              private userService: UserService,
              private cartService: CartService) {
    this.token = JSON.parse(localStorage.getItem('token'));
  }

  ngOnInit() {
    this.loadGames();
  }

  loadGames() {
    this.gameService.getGames()
      .subscribe(data => this.games = data);
  }

  loadGenreGames(id: number) {
    this.gameService.getGenreGames(id)
      .subscribe(data => this.games = data);
  }

  viewGame(id: number) {
    this.gameService.viewGame(id);
  }

  addToCart(game_id: number){
    this.cartService.addToCart(game_id);
    location.reload();
  }

  addToWishlist(game_id: number){
    this.cartService.addToWishlist(game_id);
    location.reload();
  }
}
