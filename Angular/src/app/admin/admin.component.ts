import {Component, OnInit} from "@angular/core";
import {Game} from "../game/game.model";
import {GameService} from "../game/game.service";

@Component({
  selector: 'admin',
  templateUrl: './admin.component.html'
})
export class AdminComponent implements OnInit {
  games: Game[];

  constructor(private gameService: GameService) {
  }

  ngOnInit() {
    this.loadGames();
  }

  loadGames() {
    this.gameService.getGames()
      .subscribe(data => this.games = data);
  }

  viewGame(id: number) {
    this.gameService.viewGame(id);
  }
}
