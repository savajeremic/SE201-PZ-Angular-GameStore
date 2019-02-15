import {Component, OnInit} from "@angular/core";
import {Game} from "../../game/game.model";
import {GameService} from "../../game/game.service";
import {UserService} from "../user.service";

@Component({
  selector: 'app-user-games',
  templateUrl: './usergames.component.html'
})
export class UserGamesComponent implements OnInit {
  games: Game[];

  constructor(private gameService: GameService,
              private userService: UserService) {
  }

  ngOnInit() {
    this.loadUserGames();
  }

  loadUserGames() {
    this.gameService.getUserGames()
      .subscribe(data => this.games = data);
  }

  viewGame(id: number) {
    this.gameService.viewGame(id);
  }
}
