import {Component, OnInit} from "@angular/core";
import {Game} from "../game.model";
import {GameService} from "../game.service";
import {UserService} from "../../user/user.service";
import {CartService} from "../../user/cart/cart.service";
import {Router, ActivatedRoute, Params} from '@angular/router';

@Component({
  selector: 'GenreGamesComponent',
  templateUrl: './genregames.component.html'
})

export class GenreGamesComponent implements OnInit{
  games: Game[];

  constructor(private gameService: GameService,
              private userService: UserService,
              private cartService: CartService,
              private route: ActivatedRoute,
              private router: Router) {
  }

  ngOnInit(){
    this.route.params
      .subscribe(
        params => {
          let id = +params['id'];
          this.loadGenreGames(id);
        }
      );
  }

  loadGenreGames(id: number){
    this.gameService.getGenreGames(id)
      .subscribe(data => this.games = data);
  }

  viewGame(id: number){
    this.gameService.viewGame(id);
  }

  addToCart(game_id: number){
    this.cartService.addToCart(game_id);
  }
}
